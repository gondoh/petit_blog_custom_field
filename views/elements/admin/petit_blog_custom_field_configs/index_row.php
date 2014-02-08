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
	<td class="row-tools">
	<?php $bcBaser->link($bcBaser->getImg('admin/icn_tool_edit.png', array('width' => 24, 'height' => 24, 'alt' => '編集', 'class' => 'btn')),
			array('action' => 'edit', $data['PetitBlogCustomFieldConfig']['id']), array('title' => '編集')) ?>
	</td>
	<td style="width: 45px;"><?php echo $data['PetitBlogCustomFieldConfig']['id']; ?></td>
	<td>
		<?php echo $bcBaser->link($blogContentDatas[$data['PetitBlogCustomFieldConfig']['blog_content_id']], array('action' => 'edit', $data['PetitBlogCustomFieldConfig']['id']), array('title' => '編集')) ?>
	</td>
	<td>
		<?php echo $bcText->booleanDo($data['PetitBlogCustomFieldConfig']['status'], '利用') ?>
	</td>
	<td><?php echo $bcText->booleanMark($data['PetitBlogCustomFieldConfig']['use_name']) ?></td>
	<td><?php echo $bcText->booleanMark($data['PetitBlogCustomFieldConfig']['use_name_2']) ?></td>
	<td><?php echo $bcText->booleanMark($data['PetitBlogCustomFieldConfig']['use_content']) ?></td>
	<td><?php echo $bcText->booleanMark($data['PetitBlogCustomFieldConfig']['use_radio']) ?></td>
	<td><?php echo $bcText->booleanMark($data['PetitBlogCustomFieldConfig']['use_select']) ?></td>
	<td><?php echo $bcText->booleanMark($data['PetitBlogCustomFieldConfig']['use_date']) ?></td>
	<td style="white-space: nowrap">
		<?php echo $bcTime->format('Y-m-d', $data['PetitBlogCustomFieldConfig']['created']) ?>
		<br />
		<?php echo $bcTime->format('Y-m-d', $data['PetitBlogCustomFieldConfig']['modified']) ?>
	</td>
</tr>
