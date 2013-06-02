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
		
		if($this->judgeStatus($post)) {
			if(!empty($post['PetitBlogCustomField']['name'])) {
				return $post['PetitBlogCustomField']['name'];
			}
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
		
		if($this->judgeStatus($post)) {
			return $post['PetitBlogCustomField']['name_2'];
		}
		
	}
/**
 * 「テキストエリア」を取得する
 *
 * @param array $post
 * @param array $options
 * @return string
 * @access public
 */
	function getPbcfContent($post, $options = array()) {
		
		if($this->judgeStatus($post)) {
			return $post['PetitBlogCustomField']['content'];
		}
		
	}

/**
 * 「ラジオ」を取得する
 *
 * @param array $post
 * @param array $options
 * @return string
 * @access public
 */
	function getPbcfRadio($post, $options = array()) {
		
		if($this->judgeStatus($post)) {
			$config = Configure::read('petitBlogCustomField.radio');
			return $config[$post['PetitBlogCustomField']['radio']];
		}
		
	}
/**
 * 「セレクト」を取得する
 *
 * @param array $post
 * @param array $options
 * @return string
 * @access public
 */
	function getPbcfSelect($post, $options = array()) {
		
		if($this->judgeStatus($post)) {
			$config = Configure::read('petitBlogCustomField.select');
			return $config[$post['PetitBlogCustomField']['select']];
		}
		
	}
/**
 * 「日付」を取得する
 *
 * @param array $post
 * @param array $options
 * @return string
 * @access public
 */
	function getPbcfDate($post, $options = array()) {
		
		if($this->judgeStatus($post)) {
			return $post['PetitBlogCustomField']['date'];
		}
		
	}
/**
 * カスタムフィールドの有効を判定する
 * 
 * @param array $post
 * @return boolean
 * @access public
 */	
	function judgeStatus($post = array()) {
		
		if(!empty($post['PetitBlogCustomField']['status'])) {
			if($post['PetitBlogCustomField']['status']) {
				return true;
			}
		}
		
		return false;
		
	}
/**
 * プチ・カスタムフィールド一覧を表示する
 *
 * @param array $post
 * @param array $options
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
