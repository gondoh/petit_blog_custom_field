<?php
/**
 * [HookHelper] petit_blog_custom_field
 *
 * @copyright		Copyright 2013, materializing.
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
class PetitBlogCustomFieldHookHelper extends AppHelper {
/**
 * 登録フック
 *
 * @var array
 * @access public
 */
	var $registerHooks = array('beforeRender', 'afterFormCreate', 'afterElement');
/**
 * ビュー
 * 
 * @var View 
 */
	var $View = null;
/**
 * petit_blog_custom_field設定情報
 * 
 * @var array
 * @access public
 */
	var $petitBlogCustomFieldConfigs = array();
/**
 * Construct 
 * 
 */
	function __construct() {
		parent::__construct();
		
		$this->View = ClassRegistry::getObject('view');
		
	}
/**
 * beforeRender
 * 
 * @return void 
 * @access public
 */
	function beforeRender() {
		parent::beforeRender();
		
		// ブログページ表示の際に実行
		if(!empty($this->params['plugin'])) {
			if($this->params['plugin'] == 'blog') {
				if (ClassRegistry::isKeySet('PetitBlogCustomField.PetitBlogCustomFieldConfig')) {
					$this->PetitBlogCustomFieldConfigModel = ClassRegistry::getObject('PetitBlogCustomField.PetitBlogCustomFieldConfig');
				}else {
					$this->PetitBlogCustomFieldConfigModel = ClassRegistry::init('PetitBlogCustomField.PetitBlogCustomFieldConfig');
				}
				$this->petitBlogCustomFieldConfigs = $this->PetitBlogCustomFieldConfigModel->read(null, $this->View->viewVars['blogContent']['BlogContent']['id']);
			}
		}
		
	}
/**
 * afterFormCreate
 * 
 * @param Object $form
 * @param string $id
 * @param string $out
 * @return string
 */
	function afterFormCreate($form, $id, $out) {
		
		if($form->params['controller'] == 'blog_posts'){
			if($form->data['PetitBlogCustomFieldConfig']['status']) {
				// ブログ記事追加画面にプチ・カスタムフィールド編集欄を追加する
				if($this->action == 'admin_add'){
					if($id == 'BlogPostForm') {
						$out = $out . $this->View->element('admin/petit_blog_custom_field_form', array('plugin' => 'petit_blog_custom_field'));
					}
				}
				// ブログ記事編集画面にプチ・カスタムフィールド編集欄を追加する
				if($this->action == 'admin_edit'){
					if($id == 'BlogPostForm') {
						$out = $out . $this->View->element('admin/petit_blog_custom_field_form', array('plugin' => 'petit_blog_custom_field'));
					}
				}
			}
		}
		
		if($form->params['controller'] == 'blog_contents'){
			// ブログ設定編集画面にプチ・カスタムフィールド設定欄を表示する
			if($this->action == 'admin_edit'){
				if($id == 'BlogContentEditForm') {
					$out = $out . $this->View->element('admin/petit_blog_custom_field_config_form', array('plugin' => 'petit_blog_custom_field'));
				}
			}
			// ブログ追加画面にプチ・カスタムフィールド設定欄を表示する
			if($this->action == 'admin_add'){
				if($id == 'BlogContentAddForm') {
					$out = $out . $this->View->element('admin/petit_blog_custom_field_config_form', array('plugin' => 'petit_blog_custom_field'));
				}
			}
		}
		
		return $out;
		
	}
/**
 * afterElement
 *
 * @param string $name
 * @param string $out
 * @return string
 * @access public
 */
	function afterElement($name, $out) {
		
		if($name == 'blog_tag') {
			if($this->petitBlogCustomFieldConfigs['PetitBlogCustomFieldConfig']['status']) {
				if($this->View->viewVars['post']['PetitBlogCustomField']['status']) {
					$post = $this->View->viewVars['post'];
					// TODO ヘルパが自動初期化されないので明示的に初期化
					$this->bcBaser = new BcBaserHelper();
					$petitBlogCustomParts = $this->bcBaser->getElement('petit_blog_custom_field_block', array('plugin' => 'petit_blog_custom_field', 'post' => $post));
					$out = $petitBlogCustomParts . $out;
				}				
			}
		}
		
		return $out;
		
	}
	
}
