<?php
/**
 * [ADMIN] PetitBlogCustomField
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			PetitBlogCustomField
 * @license			MIT
 */
?>
<tr>
	<th>プチ・ブログカスタムフィールド管理メニュー</th>
	<td>
		<ul>
			<li><?php $this->BcBaser->link('ブログカスタムフィールド一覧', array('admin' => true, 'plugin' => 'petit_blog_custom_field', 'controller' => 'petit_blog_custom_fields', 'action'=>'index')) ?></li>
			<?php if(!$judgePetitBlogCustomFieldUse): ?>
			<li><?php $this->BcBaser->link('ブログカスタムフィールド一括設定', array('admin' => true, 'plugin' => 'petit_blog_custom_field', 'controller' => 'petit_blog_custom_fields', 'action'=>'batch')) ?></li>
			<?php endif ?>
		</ul>
	</td>
</tr>
<tr>
	<th>プチ・ブログカスタムフィールド設定管理メニュー</th>
	<td>
		<ul>
			<li><?php $this->BcBaser->link('ブログカスタムフィールド設定一覧', array('admin' => true, 'plugin' => 'petit_blog_custom_field', 'controller' => 'petit_blog_custom_field_configs', 'action'=>'index')) ?></li>
			<?php if(!$judgePetitBlogCustomFieldConfigUse): ?>
			<li><?php $this->BcBaser->link('ブログカスタムフィールド設定データ作成', array('admin' => true, 'plugin' => 'petit_blog_custom_field', 'controller' => 'petit_blog_custom_field_configs', 'action'=>'first')) ?></li>
			<?php endif ?>
		</ul>
	</td>
</tr>
