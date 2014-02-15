<?php
/**
 * [HelperEventListener] PetitBlogCustomField
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			PetitBlogCustomField
 * @license			MIT
 */
class PetitBlogCustomFieldHelperEventListener extends BcHelperEventListener {
/**
 * 登録イベント
 *
 * @var array
 */
	public $events = array(
		'Form.afterCreate'
	);
	
/**
 * formAfterCreate
 * 
 * @param CakeEvent $event
 * @return array
 */
	public function formAfterCreate(CakeEvent $event) {
		$form = $event->subject();
		
		if($form->request->params['controller'] == 'blog_posts'){
			if(!empty($form->request->data['PetitBlogCustomFieldConfig']['status'])) {
				// ブログ記事追加画面にプチ・カスタムフィールド編集欄を追加する
				if($this->action == 'admin_add'){
					if($event->data[0] == 'BlogPostForm') {
						$event->data[1] = $event->data[1] . $this->View->element('admin/petit_blog_custom_field_form', array('plugin' => 'petit_blog_custom_field'));
					}
				}
				// ブログ記事編集画面にプチ・カスタムフィールド編集欄を追加する
				if($this->action == 'admin_edit'){
					if($event->data[0] == 'BlogPostForm') {
						$event->data[1] = $event->data[1] . $this->View->element('admin/petit_blog_custom_field_form', array('plugin' => 'petit_blog_custom_field'));
					}
				}
			}
		}
		
		if($form->request->params['controller'] == 'blog_contents'){
			// ブログ設定編集画面にプチ・カスタムフィールド設定欄を表示する
			if($this->action == 'admin_edit'){
				if($event->data[0] == 'BlogContentEditForm') {
					$event->data[1] = $event->data[1] . $this->View->element('admin/petit_blog_custom_field_config_form', array('plugin' => 'petit_blog_custom_field'));
				}
			}
			// ブログ追加画面にプチ・カスタムフィールド設定欄を表示する
			if($this->action == 'admin_add'){
				if($event->data[0] == 'BlogContentAddForm') {
					$event->data[1] = $event->data[1] . $this->View->element('admin/petit_blog_custom_field_config_form', array('plugin' => 'petit_blog_custom_field'));
				}
			}
		}
		
		return $event->data;
	}
	
}
