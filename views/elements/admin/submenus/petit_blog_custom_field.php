<?php
/**
 * [ADMIN] petit_blog_custom_field
 *
 * @copyright		Copyright 2013, materializing.
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
?>
<tr>
	<th>プチ・ブログカスタムフィールド管理メニュー</th>
	<td>
		<ul>
			<li><?php $bcBaser->link('ブログカスタムフィールド一覧', array('plugin' => 'petit_blog_custom_field', 'admin' => true, 'controller' => 'petit_blog_custom_fields', 'action'=>'index')) ?></li>
			<li><?php $bcBaser->link('ブログカスタムフィールド一括設定', array('plugin' => 'petit_blog_custom_field', 'admin' => true, 'controller' => 'petit_blog_custom_fields', 'action'=>'batch')) ?></li>
		</ul>
	</td>
</tr>
<tr>
	<th>プチ・ブログカスタムフィールド設定管理メニュー</th>
	<td>
		<ul><?php if($judgePetitBlogCustomFieldConfigUse): ?>
			<li><?php $bcBaser->link('ブログカスタムフィールド設定一覧', array('plugin' => 'petit_blog_custom_field', 'admin' => true, 'controller' => 'petit_blog_custom_field_configs', 'action'=>'index')) ?></li>
			<?php endif ?>
			<li><?php $bcBaser->link('ブログカスタムフィールド設定データ作成', array('plugin' => 'petit_blog_custom_field', 'admin' => true, 'controller' => 'petit_blog_custom_field_configs', 'action'=>'first')) ?></li>
		</ul>
	</td>
</tr>