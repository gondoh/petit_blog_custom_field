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
		'Blog.Form.afterCreate'
	);
	
/**
 * formAfterCreate
 * 
 * @param CakeEvent $event
 * @return array
 */
	public function blogFormAfterCreate(CakeEvent $event) {
		$Form = $event->subject();
		
		if($Form->request->params['controller'] == 'blog_posts'){
			if(!empty($Form->request->data['PetitBlogCustomFieldConfig']['status'])) {
				// ブログ記事追加画面にプチ・カスタムフィールド編集欄を追加する
				if($this->request->action == 'admin_add'){
					if($event->data['id'] == 'BlogPostForm') {
						$event->data['out'] = $event->data['out'] . $Form->element('PetitBlogCustomField.petit_blog_custom_field_form');
					}
				}
				// ブログ記事編集画面にプチ・カスタムフィールド編集欄を追加する
				if($this->request->action == 'admin_edit'){
					if($event->data['id'] == 'BlogPostForm') {
						$event->data['out'] = $event->data['out'] . $Form->element('PetitBlogCustomField.petit_blog_custom_field_form');
					}
				}
			}
		}
		
		if($Form->request->params['controller'] == 'blog_contents'){
			// ブログ設定編集画面にプチ・カスタムフィールド設定欄を表示する
			if($this->request->action == 'admin_edit'){
				if($event->data[0] == 'BlogContentEditForm') {
					$event->data[1] = $event->data[1] . $Form->element('PetitBlogCustomField.petit_blog_custom_field_config_form');
				}
			}
			// ブログ追加画面にプチ・カスタムフィールド設定欄を表示する
			if($this->request->action == 'admin_add'){
				if($event->data[0] == 'BlogContentAddForm') {
					$event->data[1] = $event->data[1] . $Form->element('PetitBlogCustomField.petit_blog_custom_field_config_form');
				}
			}
		}
		
		return $event->data;
	}
	
}
