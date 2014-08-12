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
		'Blog.Blog.beforeRender',
		'Blog.BlogPosts.beforeRender',
		'Blog.BlogContents.beforeRender'
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
 * petit_blog_custom_fieldフィールド名設定データ
 * 
 * @var array
 */
	public $settingsPetitBlogCustomField = array();
	
/**
 * initialize
 * 
 * @param CakeEvent $event
 */
	public function initialize(CakeEvent $event) {
		$Controller = $event->subject();
		// PetitBlogCustomFieldヘルパーの追加
		$Controller->helpers[] = 'PetitBlogCustomField.PetitBlogCustomField';
		$this->settingsPetitBlogCustomField = Configure::read('petitBlogCustomField');
	}
	
/**
 * blogBeforeRender
 * 
 * @param CakeEvent $event
 */
	public function blogBlogBeforeRender(CakeEvent $event) {
		$Controller = $event->subject();
		// プレビューの際は編集欄の内容を送る
		// 設定値を送る
		$Controller->viewVars['customFieldConfig'] = $this->settingsPetitBlogCustomField;
		if ($Controller->preview) {
			if (!empty($Controller->request->data['PetitBlogCustomField'])) {
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
		$Controller->viewVars['customFieldConfig'] = $this->settingsPetitBlogCustomField;

		// ブログ記事編集・追加画面で実行
		// - startup で処理したかったが $Controller->request->data に入れるとそれを全て上書きしてしまうのでダメだった
		if ($Controller->request->params['action'] == 'admin_edit') {
			$Controller->request->data['PetitBlogCustomFieldConfig'] = $this->petitBlogCustomFieldConfigs['PetitBlogCustomFieldConfig'];
			
			if ($this->petitBlogCustomFieldConfigs['PetitBlogCustomFieldConfig']['status']) {
				$this->judgeExistCustomFieldConfig($Controller);
			}
		}
		if ($Controller->request->params['action'] == 'admin_add') {
			if ($Controller->request->data('PetitBlogCustomField') == null) {
				$defalut = $this->PetitBlogCustomFieldModel->getDefaultValue();
				$Controller->request->data['PetitBlogCustomField'] = $defalut['PetitBlogCustomField'];
			}
			$Controller->request->data['PetitBlogCustomFieldConfig'] = $this->petitBlogCustomFieldConfigs['PetitBlogCustomFieldConfig'];
		}
	}
	
/**
 * blogContentsBeforeRender
 * 
 * @param CakeEvent $event
 */
	public function blogBlogContentsBeforeRender(CakeEvent $event) {
		$Controller = $event->subject();
		$this->modelInitializer($Controller);
		
		// 設定値を送る
		$Controller->viewVars['customFieldConfig'] = $this->settingsPetitBlogCustomField;
		
		// ブログ設定編集画面に設定情報を送る
		if ($Controller->request->params['action'] == 'admin_edit') {
			$this->petitBlogCustomFieldConfigs = $this->PetitBlogCustomFieldConfigModel->findByBlogContentId($Controller->BlogContent->id);
			$Controller->request->data['PetitBlogCustomFieldConfig'] = $this->petitBlogCustomFieldConfigs['PetitBlogCustomFieldConfig'];
			$this->judgeExistCustomFieldConfig($Controller);
		}
		// ブログ追加画面に設定情報を送る
		if ($Controller->request->params['action'] == 'admin_add') {
			$defalut = $this->PetitBlogCustomFieldConfigModel->getDefaultValue();
			$Controller->request->data['PetitBlogCustomFieldConfig'] = $defalut['PetitBlogCustomFieldConfig'];
			$this->judgeExistCustomFieldConfig($Controller);
		}
	}
	
/**
 * モデル登録用メソッド
 * 
 * @param Controller $Controller
 */
	public function modelInitializer($Controller) {
		if (ClassRegistry::isKeySet('PetitBlogCustomField.PetitBlogCustomFieldConfig')) {
			$this->PetitBlogCustomFieldConfigModel = ClassRegistry::getObject('PetitBlogCustomField.PetitBlogCustomFieldConfig');
		} else {
			$this->PetitBlogCustomFieldConfigModel = ClassRegistry::init('PetitBlogCustomField.PetitBlogCustomFieldConfig');
		}
		$this->petitBlogCustomFieldConfigs = $this->PetitBlogCustomFieldConfigModel->read(null, $Controller->BlogContent->id);
		$this->PetitBlogCustomFieldModel = ClassRegistry::init('PetitBlogCustomField.PetitBlogCustomField');
	}
	
/**
 * ブログコンテンツ用のカスタム項目設定の有無を判定する
 * 
 * @param Controller $Controller
 */
	public function judgeExistCustomFieldConfig($Controller) {
		if (!isset($this->settingsPetitBlogCustomField['field_name'][$Controller->BlogContent->id]) ||
			!isset($this->settingsPetitBlogCustomField['status'][$Controller->BlogContent->id]) ||
			!isset($this->settingsPetitBlogCustomField['radio'][$Controller->BlogContent->id]) ||
			!isset($this->settingsPetitBlogCustomField['select'][$Controller->BlogContent->id])
		) {
			$message = '以下のファイルにて、このブログで利用するカスタム項目設定を定義してください。<br />/PetitBlogCustomField/Config/petit_blog_custom_field_custom.php';
			$Controller->setMessage($message, true);
		}
	}
}
