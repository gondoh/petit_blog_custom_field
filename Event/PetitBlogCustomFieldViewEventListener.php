<?php
/**
 * [ViewEventListener] PetitBlogCustomField
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			PetitBlogCustomField
 * @license			MIT
 */
class PetitBlogCustomFieldViewEventListener extends BcViewEventListener {
/**
 * 登録イベント
 *
 * @var array
 */
	public $events = array(
		'BlogPost.beforeRender',
		'BlogContent.beforeRender',
		'Blog.afterElement'
	);
	
/**
 * petit_blog_custom_field設定情報
 * 
 * @var array
 */
	public $petitBlogCustomFieldConfigs = array();
	
/**
 * blogPostBeforeRender
 * 
 * @param CakeEvent $event
 */
	public function blogPostBeforeRender(CakeEvent $event) {
		$View = $event->subject();
		// ブログページ表示の際に実行
		if (BcUtil::isAdminSystem()) {
			if (ClassRegistry::isKeySet('PetitBlogCustomField.PetitBlogCustomFieldConfig')) {
				$this->PetitBlogCustomFieldConfigModel = ClassRegistry::getObject('PetitBlogCustomField.PetitBlogCustomFieldConfig');
			} else {
				$this->PetitBlogCustomFieldConfigModel = ClassRegistry::init('PetitBlogCustomField.PetitBlogCustomFieldConfig');
			}
			// 404に遷移した場合などで undifined が出るため判定する
			if (!empty($View->viewVars['blogContent']['BlogContent']['id'])) {
				$this->petitBlogCustomFieldConfigs = $this->PetitBlogCustomFieldConfigModel->read(null, $View->viewVars['blogContent']['BlogContent']['id']);
			}
		}
	}
	
/**
 * blogAfterElement
 * 
 * @param CakeEvent $event
 * @return string
 */
	public function blogAfterElement(CakeEvent $event) {
		$View = $event->subject();
		if($event->data['name'] == 'blog_tag') {
			if($this->petitBlogCustomFieldConfigs['PetitBlogCustomFieldConfig']['status']) {
				if($View->viewVars['post']['PetitBlogCustomField']['status']) {
					$post = $View->viewVars['post'];
					// TODO ヘルパが自動初期化されないので明示的に初期化
					$this->bcBaser = new BcBaserHelper();
					$petitBlogCustomParts = $this->bcBaser->getElement('petit_blog_custom_field_block', array('plugin' => 'petit_blog_custom_field', 'post' => $post));
					$event->data['out'] = $petitBlogCustomParts . $event->data['out'];
				}
			}
		}
		return $event->data['out'];
	}
	
}
