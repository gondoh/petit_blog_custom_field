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
/**
 * フィールド名設定
 * 
 */
$config['petitBlogCustomField.field_name'] = array(
	'name'		=> 'テキストtext',
	'name_2'	=> 'テキスト2',
	'textarea'	=> 'テキストエリアhoge',
	'radio'		=> 'ラジオ',
	'select'	=> 'セレクト',
	'date'		=> '日付'
);
/**
 * プチ・カスタムフィールドデフォルト設定
 * 
 */
/**
 * ラジオ設定
 * 
 */
$config['petitBlogCustomField.status'] = array(
	0 => '利用しない',
	1 => '利用する'
);
/**
 * ラジオ設定
 * 
 */
$config['petitBlogCustomField.radio'] = array(
	0 => '指定無し',
	1 => 'ラジオ1',
	2 => 'ラジオ2'
);
/**
 * セレクト設定
 * 
 */
$config['petitBlogCustomField.select'] = array(
	0 => '指定無し',
	1 => 'セレクト1',
	2 => 'セレクト2',
	3 => 'セレクト3'
);
