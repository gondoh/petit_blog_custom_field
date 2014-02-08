<?php
/**
 * PetitBlogCustomFieldモデル
 *
 * @copyright		Copyright 2013, materializing.
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
class PetitBlogCustomField extends BaserPluginAppModel {
/**
 * モデル名
 * 
 * @var string
 * @access public
 */
	var $name = 'PetitBlogCustomField';
/**
 * プラグイン名
 * 
 * @var string
 * @access public
 */
	var $plugin = 'PetitBlogCustomField';
/**
 * belongsTo
 * 
 * @var array
 * @access @public
 */
	var $belongsTo = array(
		'BlogPost' => array(
			'className'	=> 'Blog.BlogPost',
			'foreignKey' => 'blog_post_id'
			)
		);
/**
 * バリデーション
 *
 * @var array
 * @access public
 */
	var $validate = array(
		'name' => array(
			'maxLength' => array(
				'rule'		=> array('maxLength', 255),
				'message'	=> '255文字以内で入力してください。'
			)
		),
		'name_2' => array(
			'maxLength' => array(
				'rule'		=> array('maxLength', 255),
				'message'	=> '255文字以内で入力してください。'
			)
		)
	);
/**
 * 初期値を取得する
 *
 * @return array
 * @access public
 */
	function getDefaultValue() {
		
		$data = array(
			'PetitBlogCustomField' => array(
				'radio' => 0,
				'select' => 0
			)
		);
		return $data;
		
	}
	
}
