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
<?php if($this->params['controller'] == 'blog_contents'): ?>
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

<?php $style = '' ?>
<?php if($this->params['controller'] == 'blog_contents'): ?>
	<?php $style = ' style="display: none;"' ?>
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
			<?php echo $bcForm->label('PetitBlogCustomFieldConfig.use_petit', 'プチ・カスタムフィールドの利用') ?>
			<?php echo $html->image('admin/icn_help.png', array('id' => 'helpUsePetit', 'class' => 'btn help', 'alt' => 'ヘルプ')) ?>
			<div id="helptextUsePetit" class="helptext">
				<ul>
					<li>ブログ記事でのプチ・カスタムフィールドの利用の有無を指定します。</li>
				</ul>
			</div>
		</th>
		<td class="col-input">
			<?php echo $bcForm->input('PetitBlogCustomFieldConfig.use_petit', array('type' => 'radio', 'options' => $bcText->booleanDoList('利用'))) ?>
			<?php echo $bcForm->error('PetitBlogCustomFieldConfig.use_petit') ?>
		</td>
	</tr>
</table>
</div>
