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
	1 => array(
		'name'		=> 'テキスト',
		'name_2'	=> 'テキスト2',
		'textarea'	=> 'テキストエリア',
		'radio'		=> 'ラジオ',
		'select'	=> 'セレクト',
		'date'		=> '日付',
		'text_sub_1' => 'サブテキスト01',
		'text_sub_2' => 'サブテキスト02',
		'text_sub_3' => 'サブテキスト03',
		'text_sub_4' => 'サブテキスト04',
		'text_sub_5' => 'サブテキスト05',
		'text_sub_6' => 'サブテキスト06',
		'text_sub_7' => 'サブテキスト07',
		'text_sub_8' => 'サブテキスト08',
		'text_sub_9' => 'サブテキスト09',
		'text_sub_10' => 'サブテキスト10'
	),
	2 => array(
		'name'		=> 'テキスト',
		'name_2'	=> 'テキスト2',
		'textarea'	=> 'テキストエリア',
		'radio'		=> 'ラジオ',
		'select'	=> 'セレクト',
		'date'		=> '日付',
		'text_sub_1' => 'サブテキスト01',
		'text_sub_2' => 'サブテキスト02',
		'text_sub_3' => 'サブテキスト03',
		'text_sub_4' => 'サブテキスト04',
		'text_sub_5' => 'サブテキスト05',
		'text_sub_6' => 'サブテキスト06',
		'text_sub_7' => 'サブテキスト07',
		'text_sub_8' => 'サブテキスト08',
		'text_sub_9' => 'サブテキスト09',
		'text_sub_10' => 'サブテキスト10'
	)
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
	1 => array(
		0 => '利用しない',
		1 => '利用する'
	)
);
/**
 * ラジオ設定
 * 
 */
$config['petitBlogCustomField.radio'] = array(
	1 => array(
		0 => '指定無し',
		1 => 'ラジオ1',
		2 => 'ラジオ2'
	)
);
/**
 * セレクト設定
 * 
 */
$config['petitBlogCustomField.select'] = array(
	1 => array(
		0 => '指定無し',
		1 => 'セレクト1',
		2 => 'セレクト2',
		3 => 'セレクト3'
	)
);
