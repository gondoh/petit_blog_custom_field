<?php
/**
 * [ADMIN] petit_blog_custom_field
 *
 * @copyright		Copyright 2013, materializing.
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
/**
 * システムナビ
 */
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
			array('name' => 'ブログカスタムフィールド一括設定',
				'url' => array(
					'admin' => true,
					'plugin' => 'petit_blog_custom_field',
					'controller' => 'petit_blog_custom_fields',
					'action' => 'batch')
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
