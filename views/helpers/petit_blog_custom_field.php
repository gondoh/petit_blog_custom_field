<?php
/**
 * [Helper] petit_blog_custom_field
 *
 * @copyright		Copyright 2013, materializing.
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
class PetitBlogCustomFieldHelper extends AppHelper {
/**
 * ヘルパー
 *
 * @var array
 * @access public
 */
	var $helpers = array('Blog', 'Html');
/**
 * 「テキスト」を取得する
 *
 * @param array $post
 * @param array $options
 * @return string
 * @access public
 */
	function getPbcfName($post, $options = array()) {
		
		if(!empty($post['PetitBlogCustomField']['name'])) {
			return $post['PetitBlogCustomField']['name'];
		}
		
		return;
		
	}
/**
 * 「テキスト2」を取得する
 *
 * @param array $post
 * @param array $options
 * @return string
 * @access public
 */
	function getPbcfName2($post, $options = array()) {
		
		return $post['PetitBlogCustomField']['name_2'];
		
	}
/**
 * 指定されたバナーエリア名を元にバナーを表示する
 *
 * @param string $bannerAreaName
 * @param type $options
 * @return void
 * @access public
 */
	function showPetitBlogCustomField($post = array(), $options = array()) {
		
		$_options = array(
			'template' => 'petit_blog_custom_field_block'
		);
		$options = Set::merge($_options, $options);
		extract($options);
		
		// TODO ヘルパが自動初期化されないので明示的に初期化
		$this->bcBaser = new BcBaserHelper();
		$this->bcBaser->element($template, array('plugin' => 'petit_blog_custom_field', 'post' => $post));
		
	}
	
}
