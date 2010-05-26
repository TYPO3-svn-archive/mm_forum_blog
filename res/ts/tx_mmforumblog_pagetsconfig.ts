mod.web_txmmforumM1 {
	essentialConfiguration {
		mmforumblog_blogCommentCategory = 1
		mmforumblog_blogTopicAuthor     = 1
	}

	submodules {
		installation {
			categories {
				tt_blog = MMFORUM_CONF_CATEGORY
				tt_blog {
					icon  = EXT:mm_forum_blog/res/img/mod/mmforum-conf.png
					name  = LLL:EXT:mm_forum_blog/res/lang/locallang.xml:mod.category_title_short
					title = LLL:EXT:mm_forum_blog/res/lang/locallang.xml:mod.category_title

					items {
						mmforumblog_blogCommentCategory = MMFORUM_CONF_ITEM
						mmforumblog_blogCommentCategory {
							type = special
							type.handler = EXT:mm_forum_blog/lib/class.tx_mmforumblog_modinstall.php:tx_mmforumblog_ModInstall->getForumSelector

							label       = LLL:EXT:mm_forum_blog/res/lang/locallang.xml:mod.blogCommentCategory.title
							description = LLL:EXT:mm_forum_blog/res/lang/locallang.xml:mod.blogCommentCategory.desc
						}

						mmforumblog_blogTopicAuthor = MMFORUM_CONF_ITEM
						mmforumblog_blogTopicAuthor {
							type = group
							type.table = fe_users

							label       = LLL:EXT:mm_forum_blog/res/lang/locallang.xml:mod.blogTopicAuthor.title
							description = LLL:EXT:mm_forum_blog/res/lang/locallang.xml:mod.blogTopicAuthor.desc
						}
					}
				}
			}
		}
	}

}