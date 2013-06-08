<?php
/**
 * [Controller] petit_blog_custom_field
 *
 * @copyright		Copyright 2013, materializing.
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
/**
 * Include files
 */
App::import('Controller', 'PetitBlogCustomField.PetitBlogCustomFieldApp');
class PetitBlogCustomFieldsController extends PetitBlogCustomFieldAppController {
/**
 * コントローラー名
 * 
 * @var string
 * @access public
 */
	var $name = 'PetitBlogCustomFields';
/**
 * モデル
 * 
 * @var array
 * @access public
 */
	var $uses = array('PetitBlogCustomField.PetitBlogCustomField', 'PetitBlogCustomField.PetitBlogCustomFieldConfig');
/**
 * ぱんくずナビ
 *
 * @var string
 * @access public
 */
	var $crumbs = array(
		array('name' => 'プラグイン管理', 'url' => array('plugin' => '', 'controller' => 'plugins', 'action' => 'index')),
		array('name' => 'プチ・カスタムフィールド管理', 'url' => array('plugin' => 'petit_blog_custom_field', 'controller' => 'petit_blog_custom_fields', 'action' => 'index'))
	);
/**
 * 管理画面タイトル
 *
 * @var string
 * @access public
 */
	var $adminTitle = 'プチ・ブログカスタムフィールド';
/**
 * beforeFilter
 *
 * @return	void
 * @access 	public
 */
	function beforeFilter() {
		
		parent::beforeFilter();
		
	}
/**
 * [ADMIN] 一覧
 * 
 * @return void
 * @access public
 */
	function admin_index() {
		
		$this->pageTitle = $this->adminTitle . '一覧';
		$this->search = 'petit_blog_custom_fields_index';
		$this->help = 'petit_blog_custom_fields_index';
		
		parent::admin_index();
		
	}
/**
 * [ADMIN] 編集
 * 
 * @param int $id
 * @return void
 * @access public
 */
	function admin_edit($id = null) {
		
		$this->pageTitle = $this->adminTitle . '編集';
		
		parent::admin_edit($id);
		
	}
/**
 * [ADMIN] 削除
 *
 * @param int $id
 * @return void
 * @access public
 */
	function admin_delete($id = null) {
		
		parent::admin_delete($id);
		
	}
/**
 * ブログ記事のプチ・カスタムフィールドを、ブログ別に一括で登録する
 *   ・プチ・カスタムフィールドの登録がないブログ記事に登録する
 * 
 * @return void
 * @access public
 */
	function admin_batch() {
		
		if($this->data) {
			
			// 既にプチ・カスタムフィールド登録のあるブログ記事は除外する
			// 登録済のプチ・カスタムフィールドを取得する
			$petitCustomFields = $this->PetitBlogCustomField->find('list', array(
				'conditions' => array('PetitBlogCustomField.blog_content_id' => $this->data['PetitBlogCustomField']['blog_content_id']),
				'fields' => 'blog_post_id',
				'recursive' => -1));
			// プチ・カスタムフィールドの登録がないブログ記事を取得する
			$BlogPostModel = ClassRegistry::init('Blog.BlogPost');
			if($petitCustomFields) {
				$datas = $BlogPostModel->find('all', array(
					'conditions' => array(
						'NOT' => array('BlogPost.id' => $petitCustomFields),
						'BlogPost.blog_content_id' => $this->data['PetitBlogCustomField']['blog_content_id']),
					'fields' => array('id', 'no', 'name'),
					'recursive' => -1));
			} else {
				$datas = $BlogPostModel->find('all', array(
					'conditions' => array(
						'BlogPost.blog_content_id' => $this->data['PetitBlogCustomField']['blog_content_id']),
					'fields' => array('id', 'no', 'name'),
					'recursive' => -1));
			}
			
			// プチ・カスタムフィールドを保存した数を初期化
			$count = 0;
			if($datas) {
				foreach ($datas as $data) {
					
					$this->data['PetitBlogCustomField']['blog_post_id'] = $data['BlogPost']['id'];
					$this->data['PetitBlogCustomField']['blog_post_no'] = $data['BlogPost']['no'];
					$this->data['PetitBlogCustomField']['radio'] = 0;
					$this->data['PetitBlogCustomField']['select'] = 0;
					
					$this->PetitBlogCustomField->create($this->data);
					if($this->PetitBlogCustomField->save($this->data, false)) {
						$count++;
					} else {
						$this->log('ID:' . $data['BlogPost']['id'] . 'のブログ記事のプチ・カスタムフィールド登録に失敗');
					}
					
				}
			}
			
			$this->setMessage($count . '件のプチ・カスタムフィールドを登録しました。', false, true);
			
		}
		unset($petitCustomFields);
		unset($datas);
		unset($data);
		
		$registerd = array();
		foreach ($this->blogContentDatas as $key => $blog) {
			// $key : blog_content_id
			// 登録済のプチ・カスタムフィールドを取得する
			$petitCustomFields = $this->PetitBlogCustomField->find('list', array(
				'conditions' => array('PetitBlogCustomField.blog_content_id' => $key),
				'fields' => 'blog_post_id',
				'recursive' => -1));
			// プチ・カスタムフィールドの登録がないブログ記事を取得する
			$BlogPostModel = ClassRegistry::init('Blog.BlogPost');
			if($petitCustomFields) {
				$datas = $BlogPostModel->find('all', array(
					'conditions' => array(
						'NOT' => array('BlogPost.id' => $petitCustomFields),
						'BlogPost.blog_content_id' => $key),
					'fields' => array('id', 'no', 'name'),
					'recursive' => -1));
			} else {
				$datas = $BlogPostModel->find('all', array(
					'conditions' => array(
						'BlogPost.blog_content_id' => $key),
					'fields' => array('id', 'no', 'name'),
					'recursive' => -1));
			}
			
			$registerd[] = array(
				'name' => $blog,
				'count' => count($datas)
			);
		}
		
		$this->set('registerd', $registerd);
		$this->set('blogContentDatas', $this->blogContentDatas);
		
		$this->pageTitle = $this->adminTitle . '一括設定';
		
	}
/**
 * 一覧用の検索条件を生成する
 *
 * @param array $data
 * @return array $conditions
 * @access protected
 */
	function _createAdminIndexConditions($data) {
		
		$conditions = array();
		$name = '';
		$blogContentId = '';
		
		if(isset($data['PetitBlogCustomField']['name'])) {
			$name = $data['PetitBlogCustomField']['name'];
		}
		if(isset($data['PetitBlogCustomField']['blog_content_id'])) {
			$blogContentId = $data['PetitBlogCustomField']['blog_content_id'];
		}
		if(isset($data['PetitBlogCustomField']['status']) && $data['PetitBlogCustomField']['status'] === '') {
			unset($data['PetitBlogCustomField']['status']);
		}
		
		unset($data['_Token']);
		unset($data['PetitBlogCustomField']['name']);
		unset($data['PetitBlogCustomField']['blog_content_id']);
		
		// 条件指定のないフィールドを解除
		foreach($data['PetitBlogCustomField'] as $key => $value) {
			if($value === '') {
				unset($data['PetitBlogCustomField'][$key]);
			}
		}
		
		if($data['PetitBlogCustomField']) {
			$conditions = $this->postConditions($data);
		}
		/*
		if($name) {
			$conditions[] = array(
				'PetitBlogCustomField.name LIKE' => '%'.$name.'%'
			);
		}*/
		// １つの入力指定から複数フィールド検索指定
		if($name) {
			$conditions['or'][] = array(
				'PetitBlogCustomField.name LIKE' => '%'.$name.'%'
			);
			$conditions['or'][] = array(
				'PetitBlogCustomField.name_2 LIKE' => '%'.$name.'%'
			);
		}
		if($blogContentId) {
			$conditions['and'] = array(
				'PetitBlogCustomField.blog_content_id' => $blogContentId
			);
		}
		
		if($conditions) {
			return $conditions;
		} else {
			return array();
		}
		
	}
	
}
