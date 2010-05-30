<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

	/*
	 * Add the static template for this extension.
	 */

t3lib_extMgm::addStaticFile($_EXTKEY, 'res/ts/static', 'mm_forum_blog (comments)');
t3lib_extMgm::addStaticFile($_EXTKEY, 'res/ts/staticReplace', 'mm_forum_blog (REPLACE comments)');

?>