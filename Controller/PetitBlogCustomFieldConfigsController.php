<?php
/**
 * [Controller] PetitBlogCustomField
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			PetitBlogCustomField
 * @license			MIT
 */
/**
 * Include files
 */
App::import('Controller', 'PetitBlogCustomField.PetitBlogCustomFieldApp');
class PetitBlogCustomFieldConfigsController extends PetitBlogCustomFieldAppController {
/**
 * コントローラー名
 * 
 * @var string
 */
	public $name = 'PetitBlogCustomFieldConfigs';
	
/**
 * モデル
 * 
 * @var array
 */
	//public $uses = array('PetitBlogCustomField.PetitBlogCustomField', 'PetitBlogCustomField.PetitBlogCustomFieldConfig');
	public $uses = array('PetitBlogCustomField.PetitBlogCustomFieldConfig');
	
/**
 * ぱんくずナビ
 *
 * @var string
 */
	public $crumbs = array(
		array('name' => 'プラグイン管理', 'url' => array('plugin' => '', 'controller' => 'plugins', 'action' => 'index')),
		array('name' => 'プチ・ブログカスタムフィールド設定管理', 'url' => array('plugin' => 'petit_blog_custom_field', 'controller' => 'petit_blog_custom_field_configs', 'action' => 'index'))
	);
	
/**
 * 管理画面タイトル
 *
 * @var string
 */
	public $adminTitle = 'プチ・ブログカスタムフィールド設定';
	
/**
 * beforeFilter
 *
 * @return	void
 */
	public function beforeFilter() {
		parent::beforeFilter();
	}
	
/**
 * [ADMIN] プチ・ブログカスタムフィールド設定一覧
 * 
 * @return void
 */
	public function admin_index() {
		$this->pageTitle = $this->adminTitle . '一覧';
		$this->search = 'petit_blog_custom_field_configs_index';
		$this->help = 'petit_blog_custom_field_configs_index';
		
		parent::admin_index();
	}
	
/**
 * [ADMIN] 編集
 * 
 * @param int $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->pageTitle = $this->adminTitle . '編集';
		
		parent::admin_edit($id);
	}
	
/**
 * [ADMIN] 削除
 *
 * @param int $id
 * @return void
 */
	public function admin_delete($id = null) {
		parent::admin_delete($id);
	}
	
/**
 * 各ブログ別のプチ・ブログカスタムフィールド設定データを作成する
 *   ・プチ・ブログカスタムフィールド設定データがないブログ用のデータのみ作成する
 * 
 * @return void
 */
	public function admin_first() {
		if($this->request->data) {
			$count = 0;
			if($this->blogContentDatas) {
				foreach ($this->blogContentDatas as $key => $blog) {
					
					$configData = $this->PetitBlogCustomFieldConfig->findByBlogContentId($key);
					if(!$configData) {
						$this->request->data['PetitBlogCustomFieldConfig']['blog_content_id'] = $key;
						$this->request->data['PetitBlogCustomFieldConfig']['status'] = true;
						$this->PetitBlogCustomFieldConfig->create($this->request->data);
						if(!$this->PetitBlogCustomFieldConfig->save($this->request->data, false)) {
							$this->log(sprintf('ブログID：%s の登録に失敗しました。', $key));
						} else {
							$count++;
						}
					}
					
				}
			}
			$message = sprintf('%s 件のプチ・カスタムフィールド設定を登録しました。', $count);
			$this->setMessage($message);
			$this->redirect(array('controller' => 'petit_blog_custom_field_configs', 'action' => 'index'));
		}
		
		$this->pageTitle = $this->adminTitle . 'データ作成';
	}
	
/**
 * 一覧用の検索条件を生成する
 *
 * @param array $data
 * @return array $conditions
 */
	protected function _createAdminIndexConditions($data) {	
		$conditions = array();
		$blogContentId = '';
		
		if (isset($data['PetitBlogCustomFieldConfig']['blog_content_id'])) {
			$blogContentId = $data['PetitBlogCustomFieldConfig']['blog_content_id'];
		}
		
		unset($data['_Token']);
		unset($data['PetitBlogCustomFieldConfig']['blog_content_id']);
		
		// 条件指定のないフィールドを解除
		if (!empty($data['PetitBlogCustomFieldConfig'])) {
			foreach ($data['PetitBlogCustomFieldConfig'] as $key => $value) {
				if($value === '') {
					unset($data['PetitBlogCustomFieldConfig'][$key]);
				}
			}
			if ($data['PetitBlogCustomFieldConfig']) {
				$conditions = $this->postConditions($data);
			}
		}
		
		if ($blogContentId) {
			$conditions = array(
				'PetitBlogCustomFieldConfig.blog_content_id' => $blogContentId
			);
		}
		
		if ($conditions) {
			return $conditions;
		} else {
			return array();
		}
	}
	
}
