<?php
/**
 * [Controller] PetitBlogCustomField 基底コントローラ
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			PetitBlogCustomField
 * @license			MIT
 */
class PetitBlogCustomFieldAppController extends BcPluginAppController {
/**
 * ヘルパー
 *
 * @var array
 */
	public $helpers = array('Blog.Blog');
	
/**
 * コンポーネント
 * 
 * @var     array
 */
	public $components = array('BcAuth', 'Cookie', 'BcAuthConfigure');
	
/**
 * サブメニューエレメント
 *
 * @var array
 */
	public $subMenuElements = array('petit_blog_custom_field');
	
/**
 * ぱんくずナビ
 *
 * @var string
 */
	public $crumbs = array(
		array('name' => 'プラグイン管理', 'url' => array('plugin' => '', 'controller' => 'plugins', 'action' => 'index'))
	);
	
/**
 * 管理画面タイトル
 *
 * @var string
 */
	public $adminTitle = '';
	
/**
 * ブログコンテンツデータ
 * 
 * @var array
 */
	public $blogContentDatas = array();
	
/**
 * beforeFilter
 *
 * @return	void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$judgePetitBlogCustomFieldConfigUse = false;
		$datas = $this->PetitBlogCustomFieldConfig->find('all', array('recursive' => -1));
		if($datas) {
			$judgePetitBlogCustomFieldConfigUse = true;
		} else {
			$message = '「プチ・ブログカスタムフィールド設定データ」にてプチ・ブログカスタムフィールド設定用のデータを作成して下さい。';
			$this->setMessage($message, true);
		}
		$this->set('judgePetitBlogCustomFieldConfigUse', $judgePetitBlogCustomFieldConfigUse);
		
		// ブログ情報を取得
		$BlogContentModel = ClassRegistry::init('Blog.BlogContent');
		$this->blogContentDatas = $BlogContentModel->find('list', array('recursive' => -1));
		
		$this->set('customFieldConfig', Configure::read('petitBlogCustomField'));
	}
	
/**
 * [ADMIN] 一覧表示
 * 
 * @return void
 */
	public function admin_index() {
		$default = array(
			'named' => array(
				'num' => $this->siteConfigs['admin_list_num'],
				'sortmode' => 0));
		$this->setViewConditions($this->modelClass, array('default' => $default));
		
		$conditions = $this->_createAdminIndexConditions($this->data);
		$this->paginate = array(
			'conditions'	=> $conditions,
			'fields'		=> array(),
			'limit'			=> $this->passedArgs['num']
		);
		$datas = $this->paginate($this->modelClass);
		if($datas) {
			$this->set('datas', $datas);
		}
		$this->set('blogContentDatas', array('0' => '指定しない') + $this->blogContentDatas);
	}
	
/**
 * [ADMIN] 編集
 * 
 * @param int $id
 * @return void
 */
	public function admin_edit($id = null) {
		if(!$id) {
			$this->setMessage('無効な処理です。', true);
			$this->redirect(array('action' => 'index'));			
		}
		
		if(empty($this->data)) {
			$this->{$this->modelClass}->id = $id;
			$this->data = $this->{$this->modelClass}->read();
		} else {
			$this->{$this->modelClass}->set($this->data);
			if ($this->{$this->modelClass}->save($this->data)) {
				$this->setMessage('更新が完了しました。');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->setMessage('入力エラーです。内容を修正して下さい。', true);
			}
		}
		
		$this->set('blogContentDatas', array('0' => '指定しない') + $this->blogContentDatas);
		$this->render('form');
	}
	
/**
 * [ADMIN] 削除
 *
 * @param int $id
 * @return void
 */
	public function admin_delete($id = null) {
		if(!$id) {
			$this->setMessage('無効な処理です。', true);
			$this->redirect(array('action' => 'index'));
		}
		
		if($this->{$this->modelClass}->delete($id)) {
			$message = 'NO.' . $id . 'のデータを削除しました。';
			$this->setMessage($message);
			$this->redirect(array('action' => 'index'));
		} else {
			$this->setMessage('データベース処理中にエラーが発生しました。', true);
		}
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * [ADMIN] 無効状態にする
 * 
 * @param int $id
 * @return void
 */
	public function admin_unpublish($id) {	
		if(!$id) {
			$this->setMessage('この処理は無効です。', true);
			$this->redirect(array('action' => 'index'));
		}
		if($this->_changeStatus($id, false)) {
			$this->setMessage('「無効」状態に変更しました。');
			$this->redirect(array('action' => 'index'));
		}
		$this->setMessage('処理に失敗しました。', true);
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * [ADMIN] 有効状態にする
 * 
 * @param int $id
 * @return void
 */
	public function admin_publish($id) {
		if(!$id) {
			$this->setMessage('この処理は無効です。', true);
			$this->redirect(array('action' => 'index'));
		}
		if($this->_changeStatus($id, true)) {
			$this->setMessage('「有効」状態に変更しました。');
			$this->redirect(array('action' => 'index'));
		}
		$this->setMessage('処理に失敗しました。', true);
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * ステータスを変更する
 * 
 * @param int $id
 * @param boolean $status
 * @return boolean 
 */
	public function _changeStatus($id, $status) {
		$data = $this->{$this->modelClass}->find('first', array('conditions' => array("$this->modelClass.id" => $id), 'recursive' => -1));
		$data["$this->modelClass"]['status'] = $status;
		if($status) {
			$data["$this->modelClass"]['status'] = true;
		} else {
			$data["$this->modelClass"]['status'] = false;
		}
		
		$this->{$this->modelClass}->set($data);
		if($this->{$this->modelClass}->save()) {
			return true;
		} else {
			return false;
		}
	}
	
}
