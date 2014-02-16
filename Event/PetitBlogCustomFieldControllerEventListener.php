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
		'Blog.Blog.startup',
		'beforeRender',
		'beforeRedirect',
		'afterBlogPostAdd',
		'afterBlogPostEdit'
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
 * @param Controller $controller 
 */
	public function initialize(CakeEvent $event) {
		$Controller = $event->subject();
//		App::import('Helper', 'PetitBlogCustomField.PetitBlogCustomField');
//		$this->PetitBlogCustomField = new PetitBlogCustomFieldHelper();
		// PetitBlogCustomFieldヘルパーの追加
		$Controller->helpers[] = 'PetitBlogCustomField.PetitBlogCustomField';
	}
	
/**
 * blogBlogStartup
 * 
 * @param CakeEvent $event
 */
	public function blogBlogStartup(CakeEvent $event) {
		$Controller = $event->subject();
		if (ClassRegistry::isKeySet('PetitBlogCustomField.PetitBlogCustomFieldConfig')) {
			$this->PetitBlogCustomFieldConfigModel = ClassRegistry::getObject('PetitBlogCustomField.PetitBlogCustomFieldConfig');
		}else {
			$this->PetitBlogCustomFieldConfigModel = ClassRegistry::init('PetitBlogCustomField.PetitBlogCustomFieldConfig');
		}
		$this->petitBlogCustomFieldConfigs = $this->PetitBlogCustomFieldConfigModel->read(null, $Controller->BlogContent->id);
		$this->PetitBlogCustomFieldModel = ClassRegistry::init('PetitBlogCustomField.PetitBlogCustomField');
	}
	
/**
 * beforeRender
 * 
 * @param Controller $controller 
 * @return void
 */
	public function beforeRender($controller) {
		// プレビューの際は編集欄の内容を送る
		if($controller->name == 'Blog') {
			// 設定値を送る
			$controller->viewVars['customFieldConfig'] = Configure::read('petitBlogCustomField');
			
			if($controller->preview) {
				if(!empty($controller->data['PetitBlogCustomField'])) {
					$controller->viewVars['post']['PetitBlogCustomField'] = $controller->data['PetitBlogCustomField'];
				}
			}
		}
		
		if($controller->name == 'BlogPosts') {
			
			// 設定値を送る
			$controller->viewVars['customFieldConfig'] = Configure::read('petitBlogCustomField');
			
			// ブログ記事編集・追加画面で実行
			// - startup で処理したかったが $controller->data に入れるとそれを全て上書きしてしまうのでダメだった
			if($controller->action == 'admin_edit') {
				$controller->data['PetitBlogCustomFieldConfig'] = $this->petitBlogCustomFieldConfigs['PetitBlogCustomFieldConfig'];
			}
			if($controller->action == 'admin_add') {
				$defalut = $this->PetitBlogCustomFieldModel->getDefaultValue();
				$controller->data['PetitBlogCustomField'] = $defalut['PetitBlogCustomField'];
				$controller->data['PetitBlogCustomFieldConfig'] = $this->petitBlogCustomFieldConfigs['PetitBlogCustomFieldConfig'];
			}
			
			// Ajaxコピー処理時に実行
			//   ・Ajax削除時は、内部的に Model->delete が呼ばれているため afterDelete で処理可能
			if($controller->action == 'admin_ajax_copy') {
				// ブログ記事コピー保存時にエラーがなければ保存処理を実行
				if(empty($controller->BlogPost->validationErrors)) {
					$petitBlogCustomFieldData = array();
					$petitBlogCustomFieldData['PetitBlogCustomField']['blog_post_id'] = $controller->viewVars['data']['BlogPost']['id'];
					$petitBlogCustomFieldData['PetitBlogCustomField']['blog_content_id'] = $controller->viewVars['data']['BlogPost']['blog_content_id'];
					$petitBlogCustomFieldData['PetitBlogCustomField']['blog_post_no'] = $controller->viewVars['data']['BlogPost']['no'];
					//$petitBlogCustomFieldData['PetitBlogCustomField']['name'] = $controller->viewVars['data']['BlogPost']['name'];
					
					$this->PetitBlogCustomFieldModel->create($petitBlogCustomFieldData);
					$this->PetitBlogCustomFieldModel->save($petitBlogCustomFieldData, false);
					// キャッシュの削除を行わないと、登録したプチ・カスタムフィールドがブログ記事編集画面に反映されない
					clearAllCache();
				}
			}
			
		}
		
		if($controller->name == 'BlogContents') {
			// 設定値を送る
			$controller->viewVars['customFieldConfig'] = Configure::read('petitBlogCustomField');
			
			// ブログ設定編集画面に設定情報を送る
			if($controller->action == 'admin_edit') {
				$this->petitBlogCustomFieldConfigs = $this->PetitBlogCustomFieldConfigModel->findByBlogContentId($controller->BlogContent->id);
				$controller->data['PetitBlogCustomFieldConfig'] = $this->petitBlogCustomFieldConfigs['PetitBlogCustomFieldConfig'];
			}
			// ブログ追加画面に設定情報を送る
			if($controller->action == 'admin_add') {
				$defalut = $this->PetitBlogCustomFieldConfigModel->getDefaultValue();
				$controller->data['PetitBlogCustomFieldConfig'] = $defalut['PetitBlogCustomFieldConfig'];
			}
			
			// Ajaxコピー処理時に実行
			//   ・Ajax削除時は、内部的に Model->delete が呼ばれているため afterDelete で処理可能
			if($controller->action == 'admin_ajax_copy') {
				// ブログコピー保存時にエラーがなければ保存処理を実行
				if(empty($controller->BlogContent->validationErrors)) {
					$configData = $this->PetitBlogCustomFieldConfigModel->findByBlogContentId($controller->params['pass']['0']);
					// もしプチ・カスタムフィールド設定の初期データ作成を行ってない事を考慮して判定している
					$saveData = array();
					if($configData) {
						$saveData['PetitBlogCustomFieldConfig']['blog_content_id'] = $controller->viewVars['data']['BlogContent']['id'];
						$saveData['PetitBlogCustomFieldConfig']['status'] = $configData['PetitBlogCustomFieldConfig']['status'];
					} else {
						$saveData['PetitBlogCustomFieldConfig']['blog_content_id'] = $controller->viewVars['data']['BlogContent']['id'];
						$saveData['PetitBlogCustomFieldConfig']['status'] = true;
					}
					
					$this->PetitBlogCustomFieldConfigModel->create($saveData);
					$this->PetitBlogCustomFieldConfigModel->save($saveData, false);
					// キャッシュの削除を行わないと、登録したプチ・カスタムフィールド設定がプチ・カスタムフィールド編集画面に反映されない
					clearAllCache();
				}
			}
			
		}
		
	}
	
/**
 * beforeRedirect
 * 
 * @param Object $controller
 * @param type $url
 * @param type $status
 * @param type $exit
 * @return void
 */
	public function beforeRedirect($controller, $url, $status, $exit) {
		if($controller->name == 'BlogContents') {
			if($controller->action == 'admin_edit') {
				// ブログ設定編集保存時に設定情報を保存する
				$this->PetitBlogCustomFieldConfigModel->set($controller->data['PetitBlogCustomFieldConfig']);
			} elseif($controller->action == 'admin_add') {
				// ブログ追加時に設定情報を保存する
				$controller->data['PetitBlogCustomFieldConfig']['blog_content_id'] = $controller->BlogContent->id;
				$this->PetitBlogCustomFieldConfigModel->create($controller->data['PetitBlogCustomFieldConfig']);
			}
			if(empty($controller->BlogContent->validationErrors)) {
				if(!$this->PetitBlogCustomFieldConfigModel->save(null, false)) {
					$this->log(sprintf('ID：%s のプチ・カスタムフィールド設定の保存に失敗しました。', $controller->data['PetitBlogCustomFieldConfig']['id']));
				}
			}
		}
	}
	
/**
 * afterBlogPostAdd
 *
 * @param Controller $controller
 * @return void
 */
	function afterBlogPostAdd($controller) {
		// ブログ記事保存時にエラーがなければ保存処理を実行
		if(empty($controller->BlogPost->validationErrors)) {
			$this->_dataSaving($controller);
		}
	}
	
/**
 * afterBlogPostEdit
 *
 * @param Controller $controller
 * @return void
 */
	public function afterBlogPostEdit($controller) {
		// ブログ記事保存時にエラーがなければ保存処理を実行
		if(empty($controller->BlogPost->validationErrors)) {
			$this->_dataSaving($controller);
		}
	}
	
/**
 * プチ・カスタムフィールド情報を保存する
 * 
 * @param Controller $controller 
 * @return void
 */
	protected function _dataSaving($controller) {
		$controller->data['PetitBlogCustomField']['blog_content_id'] = $controller->data['BlogPost']['blog_content_id'];
		$controller->data['PetitBlogCustomField']['blog_post_no'] = $controller->data['BlogPost']['no'];
		
		if($controller->action == 'admin_add') {
			$controller->data['PetitBlogCustomField']['blog_post_id'] = $controller->BlogPost->getLastInsertId();
		} else {
			$controller->data['PetitBlogCustomField']['blog_post_id'] = $controller->BlogPost->id;
		}
		
		if(empty($controller->data['PetitBlogCustomField']['id'])) {
			$this->PetitBlogCustomFieldModel->create($controller->data['PetitBlogCustomField']);
		} else {
			$this->PetitBlogCustomFieldModel->set($controller->data['PetitBlogCustomField']);
		}
		
		if(!$this->PetitBlogCustomFieldModel->save($controller->data['PetitBlogCustomField'], false)) {
			$this->log('ブログ記事ID：' . $controller->data['PetitBlogCustomField']['blog_post_id'] . 'のプチ・カスタムフィールド情報保存に失敗しました。');
		}
	}
	
}
