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
<div id="DataList">
	<?php $bcBaser->element('pagination') ?>

	<table cellpadding="0" cellspacing="0" class="list-table sort-table" id="ListTable">
		<thead>
			<tr><th style="width: 50px;">操作</th>
				<th><?php echo $paginator->sort(array(
						'asc' => $bcBaser->getImg('admin/blt_list_down.png', array('alt' => '昇順', 'title' => '昇順')).' NO',
						'desc' => $bcBaser->getImg('admin/blt_list_up.png', array('alt' => '降順', 'title' => '降順')).' NO'),
						'id', array('escape' => false, 'class' => 'btn-direction')) ?>
				</th>
				<th>
					<?php echo $paginator->sort(array(
						'asc' => $bcBaser->getImg('admin/blt_list_down.png', array('alt' => '昇順', 'title' => '昇順')).' ブログ名',
						'desc' => $bcBaser->getImg('admin/blt_list_up.png', array('alt' => '降順', 'title' => '降順')).' ブログ名'),
						'blog_content_id', array('escape' => false, 'class' => 'btn-direction')) ?>
				</th>
				<th><?php echo $paginator->sort(array(
						'asc' => $bcBaser->getImg('admin/blt_list_down.png', array('alt' => '昇順', 'title' => '昇順')).' カスタムフィールドの利用',
						'desc' => $bcBaser->getImg('admin/blt_list_up.png', array('alt' => '降順', 'title' => '降順')).' カスタムフィールドの利用'),
						'status', array('escape' => false, 'class' => 'btn-direction')) ?>
				</th>
				<th>name</th>
				<th>name_2</th>
				<th>content</th>
				<th>radio</th>
				<th>select</th>
				<th>date</th>
				<th><?php echo $paginator->sort(array(
						'asc' => $bcBaser->getImg('admin/blt_list_down.png', array('alt' => '昇順', 'title' => '昇順')).' 登録日',
						'desc' => $bcBaser->getImg('admin/blt_list_up.png', array('alt' => '降順', 'title' => '降順')).' 登録日'),
						'created', array('escape' => false, 'class' => 'btn-direction')) ?>
					<br />
					<?php echo $paginator->sort(array(
						'asc' => $bcBaser->getImg('admin/blt_list_down.png', array('alt' => '昇順', 'title' => '昇順')).' 更新日',
						'desc' => $bcBaser->getImg('admin/blt_list_up.png', array('alt' => '降順', 'title' => '降順')).' 更新日'),
						'modified', array('escape' => false, 'class' => 'btn-direction')) ?>
				</th>
			</tr>
		</thead>
	<tbody>
<?php if(!empty($datas)): ?>
	<?php foreach($datas as $data): ?>
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
	<?php endforeach; ?>
<?php else: ?>
	<tr>
		<td colspan="11"><p class="no-data">データがありません。</p></td>
	</tr>
<?php endif; ?>
	</tbody>
</table>
<!-- list-num -->
<?php $bcBaser->element('list_num') ?>
</div>
