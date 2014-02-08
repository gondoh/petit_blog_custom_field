<?php
/**
 * [HookBehavior] petit_blog_custom_field
 *
 * @copyright		Copyright 2013, materializing.
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
class PetitBlogCustomFieldHookBehavior extends ModelBehavior {
/**
 * 登録フック
 *
 * @var array
 * @access public
 */
	var $registerHooks = array(
			'BlogPost'	=> array('afterDelete', 'beforeFind', 'beforeValidate'),
			'BlogContent'	=> array('afterDelete')
	);
/**
 * afterDelete
 * 
 * @param Object $model
 * @return void
 * @access public
 */
	function afterDelete($model) {
		
		// ブログ記事削除時、そのブログ記事が持つプチ・カスタムフィールドを削除する
		if($model->alias == 'BlogPost') {
			$PetitBlogCustomFieldModel = ClassRegistry::init('PetitBlogCustomField.PetitBlogCustomField');
			$data = $PetitBlogCustomFieldModel->find('first', array(
				'conditions' => array('PetitBlogCustomField.blog_post_id' => $model->id),
				'recursive' => -1
			));
			if($data) {
				if(!$PetitBlogCustomFieldModel->delete($data['PetitBlogCustomField']['id'])) {
					$this->log('ID:' . $data['PetitBlogCustomField']['id'] . 'のプチ・カスタムフィールドの削除に失敗しました。');
				}
			}
		}
		
		// ブログ削除時、そのブログが持つプチ・カスタムフィールド設定を削除する
		if($model->alias == 'BlogContent') {
			$PetitBlogCustomFieldConfigModel = ClassRegistry::init('PetitBlogCustomField.PetitBlogCustomFieldConfig');
			$data = $PetitBlogCustomFieldConfigModel->find('first', array(
				'conditions' => array('PetitBlogCustomFieldConfig.blog_content_id' => $model->id),
				'recursive' => -1
			));
			if($data) {
				if(!$PetitBlogCustomFieldConfigModel->delete($data['PetitBlogCustomFieldConfig']['id'])) {
					$this->log('ID:' . $data['PetitBlogCustomFieldConfig']['id'] . 'のプチ・カスタムフィールド設定の削除に失敗しました。');
				}
			}
		}
		
	}
/**
 * beforeFind
 * 
 * @param Object $model
 * @param array $query
 * @return array
 */
	function beforeFind($model, $query) {
		
		if($model->alias == 'BlogPost') {
			// ブログ記事取得の際にプチ・カスタムフィールド情報も併せて取得する
			$association = array(
				'PetitBlogCustomField' => array(
					'className' => 'PetitBlogCustomField.PetitBlogCustomField',
					'foreignKey' => 'blog_post_id'
				)
			);
			$model->bindModel(array('hasOne' => $association));
			
		}
		
		return $query;
		
	}
/**
 * beforeValidate
 * 
 * @param Model $model
 * @return boolean
 * @access public
 */
	function beforeValidate($model) {
		
		if($model->alias == 'BlogPost') {
			// ブログ記事保存の手前で PetitBlogCustomField モデルのデータに対して validation を行う
			$PetitBlogCustomFieldModel = ClassRegistry::init('PetitBlogCustomField.PetitBlogCustomField');
			$PetitBlogCustomFieldModel->set($model->data);
			return $PetitBlogCustomFieldModel->validates();
			
		}
		
		return true;
		
	}
	
}
