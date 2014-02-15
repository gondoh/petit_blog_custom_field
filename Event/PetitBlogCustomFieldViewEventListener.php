<?php
/**
 * [ViewEventListener] PetitBlogCustomField
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			PetitBlogCustomField
 * @license			MIT
 */
class PetitBlogCustomFieldViewEventLister extends BcViewEventListener {
/**
 * 登録フック
 *
 * @var array
 */
	public $registerHooks = array('beforeRender', 'afterFormCreate', 'afterElement');
	
/**
 * ビュー
 * 
 * @var View 
 */
	public $View = null;
	
/**
 * petit_blog_custom_field設定情報
 * 
 * @var array
 */
	public $petitBlogCustomFieldConfigs = array();
	
/**
 * Construct 
 * 
 */
	public function __construct() {
		parent::__construct();
		$this->View = ClassRegistry::getObject('view');
	}
	
/**
 * beforeRender
 * 
 * @return void 
 */
	public function beforeRender() {
		parent::beforeRender();
		
		// ブログページ表示の際に実行
		if(empty($this->request->params['admin'])) {
			if(!empty($this->request->params['plugin'])) {
				if($this->request->params['plugin'] == 'blog') {
					if (ClassRegistry::isKeySet('PetitBlogCustomField.PetitBlogCustomFieldConfig')) {
						$this->PetitBlogCustomFieldConfigModel = ClassRegistry::getObject('PetitBlogCustomField.PetitBlogCustomFieldConfig');
					}else {
						$this->PetitBlogCustomFieldConfigModel = ClassRegistry::init('PetitBlogCustomField.PetitBlogCustomFieldConfig');
					}
					// 404に遷移した場合などで undifined が出るため判定する
					if(!empty($this->View->viewVars['blogContent']['BlogContent']['id'])) {
						$this->petitBlogCustomFieldConfigs = $this->PetitBlogCustomFieldConfigModel->read(null, $this->View->viewVars['blogContent']['BlogContent']['id']);
					}
				}
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
	public function afterFormCreate($form, $id, $out) {
		if($form->params['controller'] == 'blog_posts'){
			if(!empty($form->data['PetitBlogCustomFieldConfig']['status'])) {
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
 */
	public function afterElement($name, $out) {
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
