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
<?php if($this->params['controller'] == 'blog_posts'): ?>
<script type="text/javascript">
$(function () {
	$("#textPetitBlogCustomFieldTable").toggle(
		function() {
			$('#PetitBlogCustomFieldTable').slideDown('slow');
		},
		function() {
			$('#PetitBlogCustomFieldTable').slideUp('slow');
		}
	);
});
</script>
<style type="text/css">
	#textPetitBlogCustomFieldTable {
		cursor: pointer;
	}
</style>
<h3 id="textPetitBlogCustomFieldTable">プチ・カスタムフィールド</h3>
<?php else: ?>
<script type="text/javascript">
$(window).load(function() {
	$("#PetitBlogCustomFieldName").focus();
});
</script>
<?php endif ?>

<?php if($this->action != 'admin_add'): ?>
	<?php echo $bcForm->input('PetitBlogCustomField.id', array('type' => 'hidden')) ?>
<?php endif ?>

<?php $style = '' ?>
<?php if($this->params['controller'] == 'blog_posts'): ?>
	<?php $style = ' style="display: none;"' ?>
<?php endif ?>
<div id="PetitBlogCustomFieldTable"<?php echo $style ?>>

<table cellpadding="0" cellspacing="0" class="form-table section">
<?php if($this->params['controller'] != 'blog_posts'): ?>
	<tr>
		<th class="col-head"><?php echo $bcForm->label('PetitBlogCustomField.id', 'NO') ?></th>
		<td class="col-input">
			<?php echo $bcForm->value('PetitBlogCustomField.id') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head">ブログ名</th>
		<td class="col-input">
			<ul>
				<li><?php echo $blogContentDatas[$bcForm->value('PetitBlogCustomField.blog_content_id')] ?></li>
			</ul>
		</td>
	</tr>
<?php endif ?>
	<tr>
		<th class="col-head">
			<?php echo $bcForm->label('PetitBlogCustomField.name', 'テキスト') ?>
		</th>
		<td class="col-input">
			<?php echo $bcForm->input('PetitBlogCustomField.name', array('type' => 'text', 'size' => 40, 'maxlength' => 255, 'counter' => true)) ?>
			<?php echo $bcForm->error('PetitBlogCustomField.name') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $bcForm->label('PetitBlogCustomField.name_2', 'テキスト2') ?>
		</th>
		<td class="col-input">
			<?php echo $bcForm->input('PetitBlogCustomField.name_2', array('type' => 'text', 'size' => 40, 'maxlength' => 255, 'counter' => true)) ?>
			<?php echo $bcForm->error('PetitBlogCustomField.name_2') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $bcForm->label('PetitBlogCustomField.content', 'テキストエリア') ?>
		</th>
		<td class="col-input">
			<?php echo $bcForm->input('PetitBlogCustomField.content', array('type' => 'textarea', 'cols' => 40, 'rows' => 4)) ?>
			<?php echo $bcForm->error('PetitBlogCustomField.content') ?>
		</td>
	</tr>

	<tr>
		<th class="col-head">
			<?php echo $bcForm->label('PetitBlogCustomField.radio', 'ラジオ') ?>
		</th>
		<td class="col-input">
			<?php echo $bcForm->input('PetitBlogCustomField.radio', array('type' => 'radio', 'options' => $customFieldConfig['radio'])) ?>
			<?php echo $bcForm->error('PetitBlogCustomField.radio') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $bcForm->label('PetitBlogCustomField.select', 'セレクト') ?>
		</th>
		<td class="col-input">
			<?php echo $bcForm->input('PetitBlogCustomField.select', array('type' => 'select', 'options' => $customFieldConfig['select'])) ?>
			<?php echo $bcForm->error('PetitBlogCustomField.select') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $bcForm->label('PetitBlogCustomField.date', '日付') ?>
		</th>
		<td class="col-input">
			<?php echo $bcForm->dateTimePicker('PetitBlogCustomField.date', array('size' => 12, 'maxlength' => 10), true) ?>
			<?php echo $bcForm->error('PetitBlogCustomField.date') ?>
		</td>
	</tr>
</table>
</div>
