<?php 
class PetitBlogCustomFieldConfigsSchema extends CakeSchema {

	public $file = 'petit_blog_custom_field_configs.php';

	public $connection = 'plugin';

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $petit_blog_custom_field_configs = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 8, 'key' => 'primary'),
		'blog_content_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 1),
		'status' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'use_name' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'use_name_2' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'use_content' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'use_radio' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'use_select' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'use_date' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'use_text_sub_1' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'use_text_sub_2' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'use_text_sub_3' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'use_text_sub_4' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'use_text_sub_5' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'use_text_sub_6' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'use_text_sub_7' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'use_text_sub_8' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'use_text_sub_9' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'use_text_sub_10' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

}
