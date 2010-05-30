<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Hauke Hain <hhpreuss@googlemail.com>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

include_once(t3lib_extMgm::extPath('t3blog').'pi1/lib/class.t3blog_div.php');
include_once(t3lib_extMgm::extPath('mm_forum_comments').'lib/class.tx_mmforumcomments_div.php');

class tx_mmforumcomments_hooks_for_blog {
  /**
 * Manipulates the result of "getTypoScriptData" - adding t3blog fields
 *
 * @param	array		$parameter: contains the data for TypoScript, recordsTable, key, uid, TS setup
 * @param	array		$pObj: parent -> calling object ($this)
 * @return	null		manipulates the original data because of parameters by reference
 */
  function getTypoScriptDataHook(&$parameter, &$pObj) {
    // get all content elemenets
  	$resContent = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
  				'uid, bodytext',		// SELECT ...
  				'tt_content',		// FROM ...
  				'irre_parentid = ' . $parameter['data']['uid'] .
  					' AND irre_parenttable=\'tx_t3blog_post\' ' .
  					($pObj==false) ? '' : $pObj->cObj->enableFields('tt_content'),
  				'uid',		// GROUP BY ...
  				'sorting'		// ORDER BY ...
  	);

  	$uidContentList = '';
  	$textBeforeDivider = '';
  	$divider = false;

  	while (false !== ($rowContent = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resContent)) && !$divider) {
  		// seperate by divider
  		$dividerInText 		= stripos($rowContent['bodytext'], '###MORE###');

  		if($dividerInText===false) {
  			$textBeforeDivider .= $rowContent['bodytext'].' ';
      } else {
        $textBeforeDivider .= substr($rowContent['bodytext'], 0, strpos($rowContent['bodytext'], '###MORE###')).' ';
      }

  		if($dividerInText > 0 ) {
  			$divider = true;
  		}	else {
  			$uidContentList .= intval($rowContent['uid']).',';
  		}
  	}

    $GLOBALS['TYPO3_DB']->sql_free_result($resContent);

  	if (strlen($uidContentList) > 1) {
  		$uidContentList = substr(nl2br($uidContentList,0,strlen($uidContentList)-1));
  	}

    // save data
    $parameter['data']['blogPid'] = t3blog_div::getBlogPid();
    $parameter['data']['contentUids'] = $uidContentList;
    $parameter['data']['textBeforeDivider'] = strip_tags($textBeforeDivider);
  }

	/**
	 * "getParameter" returns the result of this function
	 *
	 * @param	array		$paraconf: The parameter segment of the TS plugin setup
	 * @param	array		$pObj: parent -> calling object ($this)
	 * @return	array		database uid given by postVar and the parameter key to look in TypoScript parameter section
	 */
  function overwriteParameter(&$paraconf, &$pObj) {
    foreach($paraconf as $key => $value) {
      $key = substr($key, 0, strlen($key)-1);
      $uidParent = $value['uidParent'];
      $uidkey = $value['uid'];
      $gp = t3lib_div::_GP($key);

      if (!empty($gp[$uidkey])) {
        return array($key . '->' . $uidkey, $gp[$uidkey], $key);
      } elseif (!empty($gp[$uidParent][$uidkey])) {
        return array($key . '->' . $uidParent . '->' . $uidkey, $gp[$uidParent][$uidkey], $key);
      }
    }
    return array();
  }

	/**
	 * Creates a new commenttopic if none exists. Create a new post if comment
	 * is approved.	 
	 *
	 * @param	array  		$$paraconf: ...
	 * @param	object		$pObj: parent object
	 * @return	null		returns nothing
	 */
  function t3blog_aftercommentinsertion(&$paraconf, &$pObj) {
    $setup = tx_mmforumcomments_div::loadTSSetupForPage($GLOBALS['TSFE']->id);
    $parameters = array('tx_t3blog_pi1->blogList->showUid',$paraconf['postUid'],'tx_t3blog_pi1');
    $topicID = tx_mmforumcomments_div::getTopicID($GLOBALS['TSFE']->id, $parameters);

    //create new mm_forum topic if none exists
    if ($topicID === 0) {
      tx_mmforumcomments_div::createTopicForRecord($parameters, $setup['plugin.']['tx_mmforumcomments_pi1.'], $GLOBALS['TSFE']->id, $setup['plugin.']['tx_mmforum.']['storagePID'], $pObj);
    }

    if (($pObj->conf['approved']) && !($topicID === 0)){
      //create new comment in mm_forum
      include_once(t3lib_extMgm::extPath('mm_forum_comments').'lib/class.tx_mmforumcomments_createcomments.php');
      include_once(t3lib_extMgm::extPath('mm_forum_blog').'lib/class.tx_mmforumblog_div.php');
      $comAuthor = (intval($GLOBALS['TSFE']->fe_user->user['uid']) == 0) ? tx_mmforumcomments_div::getTopicAuthorUID($parameters[2], $setup['plugin.']['tx_mmforumcomments_pi1.']) : intval($GLOBALS['TSFE']->fe_user->user['uid']);
      $text = tx_mmforumblog_div::html2bbcode($pObj->cObj->stdWrap($paraconf['data']['title'], $setup['plugin.']['tx_mmforumcomments_pi1.']['t3blogTitleInCommentWrap.'])) . "\n" . tx_mmforumblog_div::html2bbcode($paraconf['data']['text']);
      tx_mmforumcomments_createcomments::createPost($topicID, $comAuthor,
                            $text,
                            $paraconf['data']['tstamp'],
                            $setup['plugin.']['tx_mmforum.']['storagePID'],
                            $paraconf['data']['author']
                        );
    }
  }

	/**
	 * Replaces the Username with the one of t3blog. Changes the postmenu so that
	 * the post looks like from a deleted user.    	 
	 *
	 * @param	array  		$marker: marker array
	 * @param	array  		$row: post data
	 * @param	array  		$topic: topic data
	 * @param	object		$obj: calling object
	 * @return	array		$marker
	 */
	public function processPostListMarkerArray($marker, $row, $topic, $obj){
    if (strlen(trim($row['tx_mmforumcomments_authorname']))>0) {
      $marker['###POSTUSER###'] = $obj->cObj->stdWrap($row['tx_mmforumcomments_authorname'], $obj->conf['list_posts.']['userinfo.']['username_stdWrap.']);

      //assuming that $topic['topic_poster'] is the same as tx_mmforumcomments_div::getTopicAuthorUID
      if($topic['topic_poster']===$row['poster_id']) {
        $marker['###POSTMENU###'] = $marker['###MESSAGEMENU###'];
        $marker['###POSTUSER###'] .= $obj->pi_getLL('user-deleted');
      }
    }
		return $marker;
	}

}

?>