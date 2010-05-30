<?php

########################################################################
# Extension Manager/Repository config file for ext "mm_forum_blog".
#
# Auto generated 30-05-2010 19:09
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Blog comments with mm_forum',
	'description' => 't3blog comments are also written to the mm_forum topic created by mm_forum_comments.',
	'category' => 'fe',
	'author' => 'Hauke Hain',
	'author_email' => 'hhpreuss@googlemail.com',
	'shy' => '',
	'dependencies' => 'cms,mm_forum,mm_forum_comments,t3blog',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '0.0.0',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'mm_forum' => '1.9.0-0.0.0',
			'mm_forum_comments' => '1.1.0-0.0.0',
			't3blog' => '0.9.1-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:16:{s:9:"ChangeLog";s:4:"c62f";s:10:"README.txt";s:4:"445c";s:12:"ext_icon.gif";s:4:"167d";s:17:"ext_localconf.php";s:4:"0ae6";s:14:"ext_tables.php";s:4:"632d";s:14:"ext_tables.sql";s:4:"26ee";s:19:"doc/wizard_form.dat";s:4:"227e";s:20:"doc/wizard_form.html";s:4:"0a46";s:32:"lib/class.tx_mmforumblog_div.php";s:4:"d5cb";s:39:"lib/class.tx_mmforumblog_modinstall.php";s:4:"eb3b";s:47:"lib/class.tx_mmforumcomments_hooks_for_blog.php";s:4:"d7dc";s:28:"res/img/mod/mmforum-conf.png";s:4:"de58";s:22:"res/lang/locallang.xml";s:4:"61ab";s:37:"res/ts/tx_mmforumblog_pagetsconfig.ts";s:4:"9577";s:23:"res/ts/static/setup.txt";s:4:"6c18";s:30:"res/ts/staticReplace/setup.txt";s:4:"78c3";}',
	'suggests' => array(
	),
);

?>