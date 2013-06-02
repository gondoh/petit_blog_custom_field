<?php 
/* SVN FILE: $Id$ */
/* PetitBlogCustomFieldConfigs schema generated on: 2013-06-03 04:06:37 : 1370199817*/
class PetitBlogCustomFieldConfigsSchema extends CakeSchema {
	var $name = 'PetitBlogCustomFieldConfigs';

	var $file = 'petit_blog_custom_field_configs.php';

	var $connection = 'plugin';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $petit_blog_custom_field_configs = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 8, 'key' => 'primary'),
		'blog_content_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 1),
		'use_petit' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
}
?>