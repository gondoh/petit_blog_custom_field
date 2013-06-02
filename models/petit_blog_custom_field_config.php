<?php
/**
 * PetitBlogCustomFieldConfig モデル
 *
 * @copyright		Copyright 2013, materializing.
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
class PetitBlogCustomFieldConfig extends BaserPluginAppModel {
/**
 * モデル名
 * 
 * @var string
 * @access public
 */
	var $name = 'PetitBlogCustomFieldConfig';
/**
 * プラグイン名
 * 
 * @var string
 * @access public
 */
	var $plugin = 'PetitBlogCustomField';
/**
 * 初期値を取得する
 *
 * @return array
 * @access public
 */
	function getDefaultValue() {
		
		$data = array(
			'PetitBlogCustomFieldConfig' => array(
				'use_petit' => true
			)
		);
		return $data;
		
	}
	
}
