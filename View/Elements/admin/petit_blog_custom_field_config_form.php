<?php
/**
 * [ADMIN] PetitBlogCustomField
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			PetitBlogCustomField
 * @license			MIT
 */
$style = '';
?>
<?php if($this->request->params['controller'] == 'blog_contents'): ?>
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
	<?php echo $this->BcForm->input('PetitBlogCustomFieldConfig.id', array('type' => 'hidden')) ?>
<?php endif ?>

<div id="PetitBlogCustomFieldConfigTable"<?php echo $style ?>>

<table cellpadding="0" cellspacing="0" class="form-table section">
<?php if($this->request->params['controller'] != 'blog_contents'): ?>
	<tr>
		<th class="col-head"><?php echo $this->BcForm->label('PetitBlogCustomFieldConfig.id', 'NO') ?></th>
		<td class="col-input">
			<?php echo $this->BcForm->value('PetitBlogCustomFieldConfig.id') ?>
		</td>
	</tr>
<?php endif ?>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomFieldConfig.status', 'カスタムフィールドの利用') ?>
			<?php echo $this->BcBaser->img('admin/icn_help.png', array('id' => 'helpPetitBlogCustomFieldConfigStatus', 'class' => 'btn help', 'alt' => 'ヘルプ')) ?>
			<div id="helptextPetitBlogCustomFieldConfigStatus" class="helptext">
				<ul>
					<li>ブログ記事でのプチ・カスタムフィールドの利用の有無を指定します。</li>
				</ul>
			</div>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomFieldConfig.status', array('type' => 'radio', 'options' => $this->BcText->booleanDoList('利用'))) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomFieldConfig.status') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomFieldConfig.use_name', $customFieldConfig['field_name']['name'] .'の利用') ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomFieldConfig.use_name', array('type' => 'radio', 'options' => $this->BcText->booleanDoList('利用'))) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomFieldConfig.use_name') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomFieldConfig.use_name_2', $customFieldConfig['field_name']['name_2'] .'の利用') ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomFieldConfig.use_name_2', array('type' => 'radio', 'options' => $this->BcText->booleanDoList('利用'))) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomFieldConfig.use_name_2') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomFieldConfig.use_content', $customFieldConfig['field_name']['textarea'] .'の利用') ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomFieldConfig.use_content', array('type' => 'radio', 'options' => $this->BcText->booleanDoList('利用'))) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomFieldConfig.use_content') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomFieldConfig.use_radio', $customFieldConfig['field_name']['radio'] .'の利用') ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomFieldConfig.use_radio', array('type' => 'radio', 'options' => $this->BcText->booleanDoList('利用'))) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomFieldConfig.use_radio') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomFieldConfig.use_select', $customFieldConfig['field_name']['select'] .'の利用') ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomFieldConfig.use_select', array('type' => 'radio', 'options' => $this->BcText->booleanDoList('利用'))) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomFieldConfig.use_select') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomFieldConfig.use_date', $customFieldConfig['field_name']['date'] .'の利用') ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomFieldConfig.use_date', array('type' => 'radio', 'options' => $this->BcText->booleanDoList('利用'))) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomFieldConfig.use_date') ?>
		</td>
	</tr>
</table>
</div>
