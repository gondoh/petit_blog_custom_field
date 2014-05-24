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
		'Blog.BlogPost.beforeFind',
		'Blog.BlogPost.beforeValidate',
		'Blog.BlogPost.afterSave',
		'Blog.BlogPost.afterDelete',
		'Blog.BlogContent.afterSave',
		'Blog.BlogContent.afterDelete'
	);
	
/**
 * プチ・カスタムフィールドモデル
 * 
 * @var Object
 */
	public $PetitBlogCustomFieldModel = null;
	
/**
 * プチ・カスタムフィールド設定モデル
 * 
 * @var Object
 */
	public $PetitBlogCustomFieldConfigModel = null;
	
/**
 * blogBlogPostBeforeFind
 * ブログ記事取得の際にプチ・カスタムフィールド情報も併せて取得する
 * 
 * @param CakeEvent $event
 */
	function blogBlogPostBeforeFind(CakeEvent $event) {
		$Model = $event->subject();
		$association = array(
			'PetitBlogCustomField' => array(
				'className' => 'PetitBlogCustomField.PetitBlogCustomField',
				'foreignKey' => 'blog_post_id'
			)
		);
		$Model->bindModel(array('hasOne' => $association));
	}
	
/**
 * blogBlogPostBeforeValidate
 * ブログ記事保存の手前で PetitBlogCustomField モデルのデータに対して validation を行う
 * 
 * @param CakeEvent $event
 * @return boolean
 */
	function blogBlogPostBeforeValidate(CakeEvent $event) {
		$Model = $event->subject();
		$PetitBlogCustomFieldModel = ClassRegistry::init('PetitBlogCustomField.PetitBlogCustomField');
		$PetitBlogCustomFieldModel->set($Model->data);
		return $PetitBlogCustomFieldModel->validates();
	}
	
/**
 * blogBlogPostAfterSave
 * 
 * @param CakeEvent $event
 */
	public function blogBlogPostAfterSave(CakeEvent $event) {
		$Model = $event->subject();
		$created = $event->data[0];
		if ($created) {
			$contentId = $Model->getLastInsertId();
		} else {
			$contentId = $Model->data[$Model->alias]['id'];
		}
		$saveData = $this->_generateSaveData($Model, $contentId);
		if (isset($saveData['PetitBlogCustomField']['id'])) {
			// ブログ記事編集保存時に設定情報を保存する
			$this->PetitBlogCustomFieldModel->set($saveData);
		} else {
			// ブログ記事追加時に設定情報を保存する
			$this->PetitBlogCustomFieldModel->create($saveData);
		}
		if (!$this->PetitBlogCustomFieldModel->save()) {
			$this->log(sprintf('ID：%s のカスタムフィールドの保存に失敗しました。', $Model->data['PetitBlogCustomField']['id']));
		}
	}
	
/**
 * blogBlogPostAfterDelete
 * 
 * @param CakeEvent $event
 */
	public function blogBlogPostAfterDelete(CakeEvent $event) {
		$Model = $event->subject();
		// ブログ記事削除時、そのブログ記事が持つプチ・カスタムフィールドを削除する
		$PetitBlogCustomFieldModel = ClassRegistry::init('PetitBlogCustomField.PetitBlogCustomField');
		$data = $PetitBlogCustomFieldModel->find('first', array(
			'conditions' => array('PetitBlogCustomField.blog_post_id' => $Model->id),
			'recursive' => -1
		));
		if ($data) {
			if (!$PetitBlogCustomFieldModel->delete($data['PetitBlogCustomField']['id'])) {
				$this->log('ID:' . $data['PetitBlogCustomField']['id'] . 'のプチ・カスタムフィールドの削除に失敗しました。');
			}
		}
	}
	
/**
 * blogBlogContentAfterSave
 * 
 * @param CakeEvent $event
 */
	public function blogBlogContentAfterSave(CakeEvent $event) {
		$Model = $event->subject();
		$created = $event->data[0];
		if ($created) {
			$contentId = $Model->getLastInsertId();
		} else {
			$contentId = $Model->data[$Model->alias]['id'];
		}
		$saveData = $this->_generateContentSaveData($Model, $contentId);
		if (isset($saveData['PetitBlogCustomFieldConfig']['id'])) {
			// ブログ設定編集保存時に設定情報を保存する
			$this->PetitBlogCustomFieldConfigModel->set($saveData);
		} else {
			// ブログ設定追加時に設定情報を保存する
			$this->PetitBlogCustomFieldConfigModel->create($saveData);
		}
		if (!$this->PetitBlogCustomFieldConfigModel->save()) {
			$this->log(sprintf('ID：%s のプチ・カスタムフィールド設定の保存に失敗しました。', $Model->data['PetitBlogCustomFieldConfig']['id']));
		}
	}
	
/**
 * blogBlogContentAfterDelete
 * 
 * @param CakeEvent $event
 */
	public function blogBlogContentAfterDelete(CakeEvent $event) {
		$Model = $event->subject();
		// ブログ削除時、そのブログが持つプチ・カスタムフィールド設定を削除する
		$PetitBlogCustomFieldConfigModel = ClassRegistry::init('PetitBlogCustomField.PetitBlogCustomFieldConfig');
		$data = $PetitBlogCustomFieldConfigModel->find('first', array(
			'conditions' => array('PetitBlogCustomFieldConfig.blog_content_id' => $Model->id),
			'recursive' => -1
		));
		if ($data) {
			if (!$PetitBlogCustomFieldConfigModel->delete($data['PetitBlogCustomFieldConfig']['id'])) {
				$this->log('ID:' . $data['PetitBlogCustomFieldConfig']['id'] . 'のプチ・カスタムフィールド設定の削除に失敗しました。');
			}
		}		
	}
	
/**
 * 保存するデータの生成
 * 
 * @param Object $Model
 * @param int $contentId
 * @return array
 */
	private function _generateSaveData($Model, $contentId) {
		$params = Router::getParams();
		$this->PetitBlogCustomFieldModel = ClassRegistry::init('PetitBlogCustomField.PetitBlogCustomField');
		$data = array();
		$modelId = $oldModelId = null;
		if ($Model->alias == 'BlogPost') {
			$modelId = $contentId;
			if(!empty($params['pass'][1])) {
				$oldModelId = $params['pass'][1];
			}
		}
		
		if ($contentId) {
			$data = $this->PetitBlogCustomFieldModel->find('first', array('conditions' => array(
				'PetitBlogCustomField.blog_post_id' => $contentId
			)));
		}
		if ($params['action'] != 'admin_ajax_copy') {
			if ($data) {
				// 編集時
				if (!empty($Model->data['PetitBlogCustomField'])) {
					$data['PetitBlogCustomField'] = $Model->data['PetitBlogCustomField'];
				}
			} else {
				// 追加時
				$data['PetitBlogCustomField']['blog_post_id'] = $contentId;
			}
		} else {
			// Ajaxコピー処理時に実行
			// ブログコピー保存時にエラーがなければ保存処理を実行
			if (empty($Model->validationErrors)) {
				$_data = array();
				if ($oldModelId) {
					$_data = $this->PetitBlogCustomFieldModel->find('first', array(
						'conditions' => array(
							'PetitBlogCustomField.blog_post_id' => $oldModelId
						),
						'recursive' => -1
					));
				}
				// XXX もしカスタムフィールド設定の初期データ作成を行ってない事を考慮して判定している
				if ($_data) {
					// コピー元データがある時
					$data['PetitBlogCustomField'] = $_data['PetitBlogCustomField'];
					$data['PetitBlogCustomField']['blog_post_id'] = $contentId;
					unset($data['PetitBlogCustomField']['id']);
				} else {
					// コピー元データがない時
					$data['PetitBlogCustomField']['blog_post_id'] = $modelId;
				}
			}
		}
		
		return $data;
	}
	
/**
 * 保存するデータの生成
 * 
 * @param Object $Model
 * @param int $contentId
 * @return array
 */
	private function _generateContentSaveData($Model, $contentId) {
		$params = Router::getParams();
		$this->PetitBlogCustomFieldConfigModel = ClassRegistry::init('PetitBlogCustomField.PetitBlogCustomFieldConfig');
		$data = array();
		if ($Model->alias == 'BlogContent') {
			$modelId = $contentId;
			$oldModelId = $params['pass'][0]; 
		}
				
		if ($contentId) {
			$data = $this->PetitBlogCustomFieldConfigModel->find('first', array('conditions' => array(
				'PetitBlogCustomFieldConfig.blog_content_id' => $contentId
			)));
		}
		if ($params['action'] != 'admin_ajax_copy') {
			if ($data) {
				// 編集時
				$data['PetitBlogCustomFieldConfig'] = array_merge($data['PetitBlogCustomFieldConfig'], $Model->data['PetitBlogCustomFieldConfig']);
			} else {
				// 追加時
				$data['PetitBlogCustomFieldConfig']['blog_content_id'] = $contentId;
			}
		} else {
			// Ajaxコピー処理時に実行
			// ブログコピー保存時にエラーがなければ保存処理を実行
			if (empty($Model->validationErrors)) {
				$_data = $this->PetitBlogCustomFieldConfigModel->find('first', array(
					'conditions' => array(
						'PetitBlogCustomFieldConfig.blog_content_id' => $oldModelId
					),
					'recursive' => -1
				));
				// XXX もしキーワード設定の初期データ作成を行ってない事を考慮して判定している
				if ($_data) {
					// コピー元データがある時
					$data['PetitBlogCustomFieldConfig']['blog_content_id'] = $contentId;
					unset($data['PetitBlogCustomFieldConfig']['id']);
				} else {
					// コピー元データがない時
					$data['PetitBlogCustomFieldConfig']['blog_content_id'] = $modelId;
				}
			}
		}
		
		return $data;
	}
	
}
