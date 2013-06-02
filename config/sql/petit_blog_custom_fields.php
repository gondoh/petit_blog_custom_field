<?php 
/* SVN FILE: $Id$ */
/* PetitBlogCustomFields schema generated on: 2013-06-01 23:06:10 : 1370095450*/
class PetitBlogCustomFieldsSchema extends CakeSchema {
	var $name = 'PetitBlogCustomFields';

	var $file = 'petit_blog_custom_fields.php';

	var $connection = 'plugin';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $petit_blog_custom_fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'blog_post_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 8),
		'blog_content_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 8),
		'blog_post_no' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 8),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'name_2' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'content' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'radio' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 2),
		'select' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 2),
		'date' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
}
?>