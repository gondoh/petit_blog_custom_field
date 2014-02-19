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
	<td class="row-tools">
	<?php // ブログ記事編集画面へ移動 ?>
	<?php $this->BcBaser->link($this->BcBaser->getImg('admin/icn_tool_check.png', array('width' => 24, 'height' => 24, 'alt' => 'ブログ記事編集', 'class' => 'btn')),
			array('admin' => true, 'plugin' => 'blog', 'controller' => 'blog_posts', 'action' => 'edit', $data['BlogPost']['blog_content_id'], $data['BlogPost']['id']), array('title' => 'ブログ記事編集')) ?>

	<?php $this->BcBaser->link($this->BcBaser->getImg('admin/icn_tool_edit.png', array('width' => 24, 'height' => 24, 'alt' => '編集', 'class' => 'btn')),
			array('action' => 'edit', $data['PetitBlogCustomField']['id']), array('title' => '編集')) ?>
	<?php $this->BcBaser->link($this->BcBaser->getImg('admin/icn_tool_delete.png', 
			array('width' => 24, 'height' => 24, 'alt' => '削除', 'class' => 'btn')),
			array('action' => 'delete', $data['PetitBlogCustomField']['id'], $this->BcForm->value('PetitBlogCustomField.id')), 
			array('title' => '削除', 'class' => 'btn-delete'),
			sprintf('ID：%s のデータを削除して良いですか？', $data['PetitBlogCustomField']['id']), false) ?>
	</td>
	<td style="width: 45px;">
		<?php echo $this->BcBaser->link($data['PetitBlogCustomField']['id'], array('action' => 'edit', $data['PetitBlogCustomField']['id']), array('title' => '編集')) ?>
	</td>
	<td>
		<?php echo $blogContentDatas[$data['PetitBlogCustomField']['blog_content_id']] ?>
	</td>
	<td>
		<?php echo $data['PetitBlogCustomField']['name'] ?>
	</td>
	<td>
		<?php echo $this->BcText->booleanDo($data['PetitBlogCustomField']['status'], '利用') ?>
	</td>
	<td style="white-space: nowrap">
		<?php echo $this->BcTime->format('Y-m-d', $data['PetitBlogCustomField']['created']) ?>
		<br />
		<?php echo $this->BcTime->format('Y-m-d', $data['PetitBlogCustomField']['modified']) ?>
	</td>
</tr>
