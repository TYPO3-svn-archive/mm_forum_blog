<?php

########################################################################
# Extension Manager/Repository config file for ext "mm_forum_blog".
#
# Auto generated 24-05-2010 14:23
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
	'dependencies' => 'cms,mm_forum,mm_forum_comments',
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
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:5:{s:9:"ChangeLog";s:4:"5477";s:10:"README.txt";s:4:"ee2d";s:12:"ext_icon.gif";s:4:"1bdc";s:19:"doc/wizard_form.dat";s:4:"227e";s:20:"doc/wizard_form.html";s:4:"0a46";}',
);

?>