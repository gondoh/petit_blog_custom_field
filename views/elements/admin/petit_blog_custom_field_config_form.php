<?php
/**
 * [ADMIN] petit_blog_custom_field
 *
 * @copyright		Copyright 2013, materializing.
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
$style = '';
?>
<?php if($this->params['controller'] == 'blog_contents'): ?>
<?php $style = ' style="display: none;"' ?>
<script type="text/javascript">
$(function () {
	$("#textPetitBlogCustomFieldConfigTable").toggle(
		function() {
			$('#PetitBlogCustomFieldConfigTable').slideDown('slow');
		},
		function() {
			$('#PetitBlogCustomFieldConfigTable').slideUp('slow');
		}
	);
});
</script>
<style type="text/css">
	#textPetitBlogCustomFieldConfigTable {
		cursor: pointer;
	}
</style>
<h3 id="textPetitBlogCustomFieldConfigTable">プチ・カスタムフィールド設定</h3>
<?php endif ?>

<?php if($this->action != 'admin_add'): ?>
	<?php echo $bcForm->input('PetitBlogCustomFieldConfig.id', array('type' => 'hidden')) ?>
<?php endif ?>

<div id="PetitBlogCustomFieldConfigTable"<?php echo $style ?>>

<table cellpadding="0" cellspacing="0" class="form-table section">
<?php if($this->params['controller'] != 'blog_contents'): ?>
	<tr>
		<th class="col-head"><?php echo $bcForm->label('PetitBlogCustomFieldConfig.id', 'NO') ?></th>
		<td class="col-input">
			<?php echo $bcForm->value('PetitBlogCustomFieldConfig.id') ?>
		</td>
	</tr>
<?php endif ?>
	<tr>
		<th class="col-head">
			<?php echo $bcForm->label('PetitBlogCustomFieldConfig.status', 'プチ・カスタムフィールドの利用') ?>
			<?php echo $bcBaser->img('admin/icn_help.png', array('id' => 'helpPetitBlogCustomFieldConfigStatus', 'class' => 'btn help', 'alt' => 'ヘルプ')) ?>
			<div id="helptextPetitBlogCustomFieldConfigStatus" class="helptext">
				<ul>
					<li>ブログ記事でのプチ・カスタムフィールドの利用の有無を指定します。</li>
				</ul>
			</div>
		</th>
		<td class="col-input">
			<?php echo $bcForm->input('PetitBlogCustomFieldConfig.status', array('type' => 'radio', 'options' => $bcText->booleanDoList('利用'))) ?>
			<?php echo $bcForm->error('PetitBlogCustomFieldConfig.status') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $bcForm->label('PetitBlogCustomFieldConfig.use_name', 'テキストの利用') ?>
		</th>
		<td class="col-input">
			<?php echo $bcForm->input('PetitBlogCustomFieldConfig.use_name', array('type' => 'radio', 'options' => $bcText->booleanDoList('利用'))) ?>
			<?php echo $bcForm->error('PetitBlogCustomFieldConfig.use_name') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $bcForm->label('PetitBlogCustomFieldConfig.use_name_2', 'テキスト2の利用') ?>
		</th>
		<td class="col-input">
			<?php echo $bcForm->input('PetitBlogCustomFieldConfig.use_name_2', array('type' => 'radio', 'options' => $bcText->booleanDoList('利用'))) ?>
			<?php echo $bcForm->error('PetitBlogCustomFieldConfig.use_name_2') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $bcForm->label('PetitBlogCustomFieldConfig.use_content', 'テキストエリアの利用') ?>
		</th>
		<td class="col-input">
			<?php echo $bcForm->input('PetitBlogCustomFieldConfig.use_content', array('type' => 'radio', 'options' => $bcText->booleanDoList('利用'))) ?>
			<?php echo $bcForm->error('PetitBlogCustomFieldConfig.use_content') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $bcForm->label('PetitBlogCustomFieldConfig.use_radio', 'ラジオボタンの利用') ?>
		</th>
		<td class="col-input">
			<?php echo $bcForm->input('PetitBlogCustomFieldConfig.use_radio', array('type' => 'radio', 'options' => $bcText->booleanDoList('利用'))) ?>
			<?php echo $bcForm->error('PetitBlogCustomFieldConfig.use_radio') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $bcForm->label('PetitBlogCustomFieldConfig.use_select', 'セレクトボックスの利用') ?>
		</th>
		<td class="col-input">
			<?php echo $bcForm->input('PetitBlogCustomFieldConfig.use_select', array('type' => 'radio', 'options' => $bcText->booleanDoList('利用'))) ?>
			<?php echo $bcForm->error('PetitBlogCustomFieldConfig.use_select') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $bcForm->label('PetitBlogCustomFieldConfig.use_date', '日付の利用') ?>
		</th>
		<td class="col-input">
			<?php echo $bcForm->input('PetitBlogCustomFieldConfig.use_date', array('type' => 'radio', 'options' => $bcText->booleanDoList('利用'))) ?>
			<?php echo $bcForm->error('PetitBlogCustomFieldConfig.use_date') ?>
		</td>
	</tr>
</table>
</div>
