<?php

	/*
	 * Add some additional page TSConfig. This is used to dynamically extend the
	 * mm_forum backend module.
	 */
t3lib_extMgm::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:mm_forum_blog/res/ts/tx_mmforumblog_pagetsconfig.ts">');

//mm_forum_comments
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['mm_forum_comments']['getTypoScriptDataHook'][$_EXTKEY] = 'EXT:mm_forum_blog/lib/class.tx_mmforumcomments_hooks_for_blog.php:&tx_mmforumcomments_hooks_for_blog->getTypoScriptDataHook';
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['mm_forum_comments']['overwriteParameter'][$_EXTKEY] = 'EXT:mm_forum_blog/lib/class.tx_mmforumcomments_hooks_for_blog.php:&tx_mmforumcomments_hooks_for_blog->overwriteParameter';

//t3blog
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['t3blog']['aftercommentinsertion'][$_EXTKEY] = 'EXT:mm_forum_blog/lib/class.tx_mmforumcomments_hooks_for_blog.php:&tx_mmforumcomments_hooks_for_blog->t3blog_aftercommentinsertion';

//mm_forum (author name for t3blog)
$TYPO3_CONF_VARS['EXTCONF']['mm_forum']['display']['postListMarkerArray'][] = 'EXT:mm_forum_blog/lib/class.tx_mmforumcomments_hooks_for_blog.php:&tx_mmforumcomments_hooks_for_blog';

?>