<?php 
/* SVN FILE: $Id$ */
/* PetitBlogCustomFieldConfigs schema generated on: 2013-06-09 21:06:01 : 1370781541*/
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
		'status' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'use_name' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'use_name_2' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'use_content' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'use_radio' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'use_select' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'use_date' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
}
?>