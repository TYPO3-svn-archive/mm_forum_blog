If you want to replace the t3blog commenting interface with mm_forum, insert the
static TypoScript template that contains the word "REPLACE"


Hint:
If you use t3blog commenting function mm_forum_blog creates only copies of the comments. It is recommended not to make the topic / forum writeable for everybody, because mm_forum doesn't create t3_blog comments if mm_forum posts are created (TODO).


Known "bugs" / Missing features:
- Works only with "page.10.widget.blogList.approved = 1" as the backend module creates a link to "tce_db.php" (with a command like copy, move,delete for records)
    See: http://typo3.org/documentation/document-library/core-documentation/doc_core_api/4.3.0/view/3/2/ -> Keyword: issueCommand
    See also: http://typo3.org/documentation/document-library/core-documentation/doc_core_api/4.3.0/view/3/3/#id2507501   
- You cannot comment comments as it is not yet supported by mm_forum_blog (TODO: Find t3blog "parent_id" comment, find equivalent in mm_forum and quote the post)
- Posts edited in mm_forum are not edited in t3blog comments (TODO: use mm_forum hooks)
- New post in the mm_forum topic does not create a new comment in t3blog (TODO: use mm_forum hooks) => Make topics or (better) the whole forum (you choose to let the comments be created in) read only
- You may get two E-Mail notifications: One by mm_forum and one by t3blog. 
- editing comments is not supported, neither in FE or BE