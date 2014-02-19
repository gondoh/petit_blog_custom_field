<?php
/**
 * [ControllerEventListener] PetitBlogCustomField
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			PetitBlogCustomField
 * @license			MIT
 */
class PetitBlogCustomFieldControllerEventListener extends BcControllerEventListener {
/**
 * 登録イベント
 *
 * @var array
 */
	public $events = array(
		'initialize',
		'Blog.beforeRender',
		'Blog.BlogPosts.beforeRender',
		'Blog.BlogContents.beforeRender',
		'Blog.BlogContents.beforeRedirect'
	);
	
/**
 * petit_blog_custom_fieldヘルパー
 * 
 * @var PetitBlogCustomFieldHelper
 */
	public $PetitBlogCustomField = null;
	
/**
 * petit_blog_custom_field設定情報
 * 
 * @var array
 */
	public $petitBlogCustomFieldConfigs = array();
	
/**
 * petit_blog_custom_fieldモデル
 * 
 * @var Object
 */
	public $PetitBlogCustomFieldModel = null;
	
/**
 * petit_blog_custom_field設定モデル
 * 
 * @var Object
 */
	public $PetitBlogCustomFieldConfigModel = null;
	
/**
 * initialize
 * 
 * @param CakeEvent $event
 */
	public function initialize(CakeEvent $event) {
		$Controller = $event->subject();
//		App::import('Helper', 'PetitBlogCustomField.PetitBlogCustomField');
//		$this->PetitBlogCustomField = new PetitBlogCustomFieldHelper();
		// PetitBlogCustomFieldヘルパーの追加
		$Controller->helpers[] = 'PetitBlogCustomField.PetitBlogCustomField';
	}
		
/**
 * blogBeforeRender
 * 
 * @param CakeEvent $event
 */
	public function blogBeforeRender(CakeEvent $event) {
		$Controller = $event->subject();
		// プレビューの際は編集欄の内容を送る
		// 設定値を送る
		$Controller->viewVars['customFieldConfig'] = Configure::read('petitBlogCustomField');
		if($Controller->preview) {
			if(!empty($Controller->request->data['PetitBlogCustomField'])) {
				$Controller->viewVars['post']['PetitBlogCustomField'] = $Controller->request->data['PetitBlogCustomField'];
			}
		}
	}
	
/**
 * blogPostsBeforeRender
 * 
 * @param CakeEvent $event
 */
	public function blogBlogPostsBeforeRender(CakeEvent $event) {
		$Controller = $event->subject();
		$this->modelInitializer($Controller);
			
		// 設定値を送る
		$Controller->viewVars['customFieldConfig'] = Configure::read('petitBlogCustomField');

		// ブログ記事編集・追加画面で実行
		// - startup で処理したかったが $Controller->request->data に入れるとそれを全て上書きしてしまうのでダメだった
		if($Controller->request->params['action'] == 'admin_edit') {
			$Controller->request->data['PetitBlogCustomFieldConfig'] = $this->petitBlogCustomFieldConfigs['PetitBlogCustomFieldConfig'];
		}
		if($Controller->request->params['action'] == 'admin_add') {
			$defalut = $this->PetitBlogCustomFieldModel->getDefaultValue();
			$Controller->request->data['PetitBlogCustomField'] = $defalut['PetitBlogCustomField'];
			$Controller->request->data['PetitBlogCustomFieldConfig'] = $this->petitBlogCustomFieldConfigs['PetitBlogCustomFieldConfig'];
		}		
	}
	
/**
 * blogContentsBeforeRender
 * 
 * @param Controller $controller
 */
	public function blogBlogContentsBeforeRender(CakeEvent $event) {
		$Controller = $event->subject();
		$this->modelInitializer($Controller);
		
		// 設定値を送る
		$Controller->viewVars['customFieldConfig'] = Configure::read('petitBlogCustomField');

		// ブログ設定編集画面に設定情報を送る
		if($Controller->request->params['action'] == 'admin_edit') {
			$this->petitBlogCustomFieldConfigs = $this->PetitBlogCustomFieldConfigModel->findByBlogContentId($Controller->BlogContent->id);
			$Controller->request->data['PetitBlogCustomFieldConfig'] = $this->petitBlogCustomFieldConfigs['PetitBlogCustomFieldConfig'];
		}
		// ブログ追加画面に設定情報を送る
		if($Controller->request->params['action'] == 'admin_add') {
			$defalut = $this->PetitBlogCustomFieldConfigModel->getDefaultValue();
			$Controller->request->data['PetitBlogCustomFieldConfig'] = $defalut['PetitBlogCustomFieldConfig'];
		}
	}
	
/**
 * blogContentsBeforeRedirect
 * 
 * @param CakeEvent $event
 */
	public function blogBlogContentsBeforeRedirect(CakeEvent $event) {
		$Controller = $event->subject();
		$this->modelInitializer($Controller);
		
		if (BcUtil::isAdminSystem()) {
			if($Controller->request->params['action'] == 'admin_edit') {
				// ブログ設定編集保存時に設定情報を保存する
				$this->PetitBlogCustomFieldConfigModel->set($Controller->request->data['PetitBlogCustomFieldConfig']);
			} elseif($Controller->request->params['action'] == 'admin_add') {
				// ブログ追加時に設定情報を保存する
				$Controller->request->data['PetitBlogCustomFieldConfig']['blog_content_id'] = $Controller->BlogContent->id;
				$this->PetitBlogCustomFieldConfigModel->create($Controller->request->data['PetitBlogCustomFieldConfig']);
			}
			if(empty($Controller->BlogContent->validationErrors)) {
				if(!$this->PetitBlogCustomFieldConfigModel->save(null, false)) {
					$this->log(sprintf('ID：%s のプチ・カスタムフィールド設定の保存に失敗しました。', $Controller->request->data['PetitBlogCustomFieldConfig']['id']));
				}
			}
		}
	}
	
/**
 * プチ・カスタムフィールド情報を保存する
 * 
 * @param Controller $controller 
 * @return void
 */
	protected function _dataSaving($Controller) {
		$Controller->request->data['PetitBlogCustomField']['blog_content_id'] = $Controller->request->data['BlogPost']['blog_content_id'];
		
		if($Controller->request->action == 'admin_add') {
			$Controller->request->data['PetitBlogCustomField']['blog_post_id'] = $Controller->BlogPost->getLastInsertId();
		} else {
			$Controller->request->data['PetitBlogCustomField']['blog_post_id'] = $Controller->BlogPost->id;
		}
		
		if(empty($Controller->request->data['PetitBlogCustomField']['id'])) {
			$this->PetitBlogCustomFieldModel->create($Controller->request->data['PetitBlogCustomField']);
		} else {
			$this->PetitBlogCustomFieldModel->set($Controller->request->data['PetitBlogCustomField']);
		}
		
		if(!$this->PetitBlogCustomFieldModel->save($Controller->request->data['PetitBlogCustomField'], false)) {
			$this->log('ブログ記事ID：' . $Controller->request->data['PetitBlogCustomField']['blog_post_id'] . 'のプチ・カスタムフィールド情報保存に失敗しました。');
		}
	}
	
/**
 * モデル登録用メソッド
 * 
 * @param type $Controller
 */
	function modelInitializer($Controller) {
		if (ClassRegistry::isKeySet('PetitBlogCustomField.PetitBlogCustomFieldConfig')) {
			$this->PetitBlogCustomFieldConfigModel = ClassRegistry::getObject('PetitBlogCustomField.PetitBlogCustomFieldConfig');
		}else {
			$this->PetitBlogCustomFieldConfigModel = ClassRegistry::init('PetitBlogCustomField.PetitBlogCustomFieldConfig');
		}
		$this->petitBlogCustomFieldConfigs = $this->PetitBlogCustomFieldConfigModel->read(null, $Controller->BlogContent->id);
		$this->PetitBlogCustomFieldModel = ClassRegistry::init('PetitBlogCustomField.PetitBlogCustomField');
	}
	
}
