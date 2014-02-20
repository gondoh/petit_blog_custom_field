<?php
/**
 * [Model] PetitBlogCustomField
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			PetitBlogCustomField
 * @license			MIT
 */
class PetitBlogCustomField extends BcPluginAppModel {
/**
 * モデル名
 * 
 * @var string
 */
	public $name = 'PetitBlogCustomField';
	
/**
 * プラグイン名
 * 
 * @var string
 */
	public $plugin = 'PetitBlogCustomField';
	
/**
 * belongsTo
 * 
 * @var array
 */
	public $belongsTo = array(
		'BlogPost' => array(
			'className'	=> 'Blog.BlogPost',
			'foreignKey' => 'blog_post_id'
			)
		);
	
/**
 * バリデーション
 *
 * @var array
 */
	public $validate = array(
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
 */
	public function getDefaultValue() {
		$data = array(
			'PetitBlogCustomField' => array(
				'radio'		=> 0,
				'select'	=> 0,
				'status'	=> 1
			)
		);
		return $data;
	}
	
}
