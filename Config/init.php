<?php
/**
 * [Config] PetitBlogCustomField プラグイン用
 * データベース初期化
 */
$this->Plugin->initDb('plugin', 'PetitBlogCustomField');

/**
 * ブログ情報を元にデータを作成する
 *   ・設定データがないブログ用のデータのみ作成する
 * 
 */
	App::uses('BlogContent', 'Blog.Model');
	$BlogContentModel = new BlogContent();
	$blogContentDatas = $BlogContentModel->find('list', array('recursive' => -1));
	if ($blogContentDatas) {
		CakePlugin::load('PetitBlogCustomField');
		App::uses('PetitBlogCustomFieldConfig', 'PetitBlogCustomField.Model');
		$PetitBlogCustomFieldConfigModel = new PetitBlogCustomFieldConfig();
		foreach ($blogContentDatas as $key => $blog) {
			$petitBlogCustomFieldConfig = $PetitBlogCustomFieldConfigModel->findByBlogContentId($key);
			$savaData = array();
			if(!$petitBlogCustomFieldConfig) {
				$savaData['PetitBlogCustomFieldConfig']['blog_content_id'] = $key;
				$savaData['PetitBlogCustomFieldConfig']['status'] = true;
				for ($i = 1; $i < 11; $i++) {
					$savaData['PetitBlogCustomFieldConfig']['use_text_sub_'. $i] = false;
				}
				$PetitBlogCustomFieldConfigModel->create($savaData);
				$PetitBlogCustomFieldConfigModel->save($savaData, array(
					'validate' => false,
					'callbacks' => false
				));
			}
		}
	}
/**
 * ブログ記事情報を元にデータを作成する
 *   ・データがないブログ用のデータのみ作成する
 * 
 */
	App::uses('BlogPost', 'Blog.Model');
	$BlogPostModel = new BlogPost();
	$posts = $BlogPostModel->find('all', array('recursive' => -1));
	if ($posts) {
		CakePlugin::load('PetitBlogCustomField');
		App::uses('PetitBlogCustomField', 'PetitBlogCustomField.Model');
		$PetitBlogCustomFieldModel = new PetitBlogCustomField();
		foreach ($posts as $key => $post) {
			$petitBlogCustomFieldData = $PetitBlogCustomFieldModel->findByBlogPostId($post['BlogPost']['id']);
			$savaData = array();
			if(!$petitBlogCustomFieldData) {
				$savaData['PetitBlogCustomField']['blog_post_id'] = $post['BlogPost']['id'];
				$savaData['PetitBlogCustomField']['blog_content_id'] = $post['BlogPost']['blog_content_id'];
				$PetitBlogCustomFieldModel->create($savaData);
				$PetitBlogCustomFieldModel->save($savaData, array(
					'validate' => false,
					'callbacks' => false
				));
			}
		}
	}
