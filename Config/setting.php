<?php
/**
 * [Config] PetitBlogCustomField
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			PetitBlogCustomField
 * @license			MIT
 */
/**
 * システムナビ
 */
if (BcUtil::isAdminUser()) {
$config['BcApp.adminNavi.petit_blog_custom_field'] = array(
		'name'		=> 'プチ・ブログカスタムフィールドプラグイン',
		'contents'	=> array(
			array('name' => 'ブログカスタムフィールド一覧',
				'url' => array(
					'admin' => true,
					'plugin' => 'petit_blog_custom_field',
					'controller' => 'petit_blog_custom_fields',
					'action' => 'index')
			),
			array('name' => 'ブログカスタムフィールド設定一覧',
				'url' => array(
					'admin' => true,
					'plugin' => 'petit_blog_custom_field',
					'controller' => 'petit_blog_custom_field_configs',
					'action' => 'index')
			)
	)
);
}
