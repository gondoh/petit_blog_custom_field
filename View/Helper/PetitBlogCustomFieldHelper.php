<?php
/**
 * [Helper] PetitBlogCustomField
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			PetitBlogCustomField
 * @license			MIT
 */
class PetitBlogCustomFieldHelper extends AppHelper {
/**
 * ヘルパー
 *
 * @var array
 */
	public $helpers = array('Blog.Blog', 'Html', 'BcBaser');
	
/**
 * 「テキスト」を取得する
 *
 * @param array $post
 * @param array $options
 * @return string
 */
	public function getPbcfName($post, $options = array()) {
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
 */
	public function getPbcfName2($post, $options = array()) {
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
 */
	public function getPbcfContent($post, $options = array()) {
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
 */
	public function getPbcfRadio($post, $options = array()) {
		$_options = array(
			'invisible' => false
		);
		$options = array_merge($_options, $options);
		extract($options);
		
		if($this->judgeStatus($post)) {
			$config = Configure::read('petitBlogCustomField.radio');
			if(!$post['PetitBlogCustomField']['radio']) {
				if($invisible) {
					return '';
				}
			}
			return $config[$post['PetitBlogCustomField']['radio']];
		}
	}
	
/**
 * 「セレクト」を取得する
 *
 * @param array $post
 * @param array $options
 * @return string
 */
	public function getPbcfSelect($post, $options = array()) {
		$_options = array(
			'invisible' => false
		);
		$options = array_merge($_options, $options);
		extract($options);
		
		if($this->judgeStatus($post)) {
			$config = Configure::read('petitBlogCustomField.select');
			if(!$post['PetitBlogCustomField']['select']) {
				if($invisible) {
					return '';
				}
			}
			return $config[$post['PetitBlogCustomField']['select']];
		}
	}
	
/**
 * 「日付」を取得する
 *
 * @param array $post
 * @param array $options
 * @return string
 */
	public function getPbcfDate($post, $options = array()) {
		if($this->judgeStatus($post)) {
			return $post['PetitBlogCustomField']['date'];
		}
	}
	
/**
 * 「サブテキスト」を取得する
 *
 * @param array $post
 * @param array $options
 * @return string
 */
	public function getPbcfSubText($post, $options = array()) {
		if($this->judgeStatus($post)) {
			$_options = array(
				'num' => 1
			);
			$options = array_merge($_options, $options);
			
			if(!empty($post['PetitBlogCustomField']['text_sub_'. $options['num']])) {
				return $post['PetitBlogCustomField']['text_sub_'. $options['num']];
			}
		}
		return;
	}
	
/**
 * カスタムフィールドの有効を判定する
 * 
 * @param array $post
 * @return boolean
 */	
	public function judgeStatus($post = array()) {
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
 */
	public function showPetitBlogCustomField($post = array(), $options = array()) {
		$_options = array(
			'template' => 'petit_blog_custom_field_block'
		);
		$options = Set::merge($_options, $options);
		extract($options);
		
		$this->BcBaser->element($template, array('plugin' => 'petit_blog_custom_field', 'post' => $post));
	}
	
}
