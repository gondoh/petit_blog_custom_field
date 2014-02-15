<?php
/**
 * [Model] PetitBlogCustomFieldConfig
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			PetitBlogCustomField
 * @license			MIT
 */
class PetitBlogCustomFieldConfig extends BcPluginAppModel {
/**
 * モデル名
 * 
 * @var string
 */
	public $name = 'PetitBlogCustomFieldConfig';
	
/**
 * プラグイン名
 * 
 * @var string
 */
	public $plugin = 'PetitBlogCustomField';
	
/**
 * 初期値を取得する
 *
 * @return array
 */
	public function getDefaultValue() {
		$data = array(
			'PetitBlogCustomFieldConfig' => array(
				'status' => true
			)
		);
		return $data;
	}
	
}
