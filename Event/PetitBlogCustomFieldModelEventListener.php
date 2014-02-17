<?php
/**
 * [ModelEventListener] PetitBlogCustomField
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			PetitBlogCustomField
 * @license			MIT
 */
class PetitBlogCustomFieldModelEventListener extends BcModelEventListener {
/**
 * 登録イベント
 *
 * @var array
 */
	public $events = array(
		'BlogContent.afterDelete',
		'BlogPost.afterDelete',
		'BlogPost.beforeFind',
		'BlogPost.beforeValidate'
	);
	
/**
 * blogContentAfterDelete
 * 
 * @param CakeEvent $event
 */
	public function blogContentAfterDelete(CakeEvent $event) {
		$Model = $event->subject();
		// ブログ削除時、そのブログが持つプチ・カスタムフィールド設定を削除する
		$PetitBlogCustomFieldConfigModel = ClassRegistry::init('PetitBlogCustomField.PetitBlogCustomFieldConfig');
		$data = $PetitBlogCustomFieldConfigModel->find('first', array(
			'conditions' => array('PetitBlogCustomFieldConfig.blog_content_id' => $Model->id),
			'recursive' => -1
		));
		if($data) {
			if(!$PetitBlogCustomFieldConfigModel->delete($data['PetitBlogCustomFieldConfig']['id'])) {
				$this->log('ID:' . $data['PetitBlogCustomFieldConfig']['id'] . 'のプチ・カスタムフィールド設定の削除に失敗しました。');
			}
		}		
	}
	
/**
 * blogPostAfterDelete
 * 
 * @param CakeEvent $event
 */
	public function blogPostAfterDelete(CakeEvent $event) {
		$Model = $event->subject();
		// ブログ記事削除時、そのブログ記事が持つプチ・カスタムフィールドを削除する
		$PetitBlogCustomFieldModel = ClassRegistry::init('PetitBlogCustomField.PetitBlogCustomField');
		$data = $PetitBlogCustomFieldModel->find('first', array(
			'conditions' => array('PetitBlogCustomField.blog_post_id' => $Model->id),
			'recursive' => -1
		));
		if($data) {
			if(!$PetitBlogCustomFieldModel->delete($data['PetitBlogCustomField']['id'])) {
				$this->log('ID:' . $data['PetitBlogCustomField']['id'] . 'のプチ・カスタムフィールドの削除に失敗しました。');
			}
		}
	}
	
/**
 * blogPostBeforeFind
 * 
 * @param CakeEvent $event
 */
	function blogPostBeforeFind(CakeEvent $event) {
		$Model = $event->subject();
		// ブログ記事取得の際にプチ・カスタムフィールド情報も併せて取得する
		$association = array(
			'PetitBlogCustomField' => array(
				'className' => 'PetitBlogCustomField.PetitBlogCustomField',
				'foreignKey' => 'blog_post_id'
			)
		);
		$Model->bindModel(array('hasOne' => $association));
	}
	
/**
 * blogPostBeforeValidate
 * 
 * @param CakeEvent $event
 * @return boolean
 */
	function blogPostBeforeValidate(CakeEvent $event) {
		$Model = $event->subject();
		// ブログ記事保存の手前で PetitBlogCustomField モデルのデータに対して validation を行う
		$PetitBlogCustomFieldModel = ClassRegistry::init('PetitBlogCustomField.PetitBlogCustomField');
		$PetitBlogCustomFieldModel->set($Model->data);
		return $PetitBlogCustomFieldModel->validates();
	}
	
}
