<?php
/**
 * [ADMIN] PetitBlogCustomField
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			PetitBlogCustomField
 * @license			MIT
 */
if ($this->request->params['controller'] == 'blog_posts') {
	$blogContentId = $blogContent['BlogContent']['id'];
} else {
	$blogContentId = $this->request->data['PetitBlogCustomField']['blog_content_id'];
}
$style = '';
?>
<?php if($this->request->params['controller'] == 'blog_posts'): ?>
<?php $style = ' style="display: none;"' ?>
<script type="text/javascript">
$(function () {
	var PetitBlogCustomFieldStatusValue = $('input[name="data[PetitBlogCustomField][status]"]:checked').val();
	if(PetitBlogCustomFieldStatusValue == 1) {
		$('#PetitBlogCustomFieldTable').slideDown('slow');
	}

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

<?php if($this->request->action != 'admin_add'): ?>
	<?php echo $this->BcForm->input('PetitBlogCustomField.id', array('type' => 'hidden')) ?>
<?php endif ?>

<div id="PetitBlogCustomFieldTable"<?php echo $style ?>>

<table cellpadding="0" cellspacing="0" class="form-table section">
<?php if($this->request->params['controller'] != 'blog_posts'): ?>
	<tr>
		<th class="col-head"><?php echo $this->BcForm->label('PetitBlogCustomField.id', 'NO') ?></th>
		<td class="col-input">
			<?php echo $this->BcForm->value('PetitBlogCustomField.id') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head">ブログ名</th>
		<td class="col-input">
			<ul>
				<li><?php echo $blogContentDatas[$this->BcForm->value('PetitBlogCustomField.blog_content_id')] ?></li>
			</ul>
		</td>
	</tr>
<?php endif ?>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomField.status', 'この記事での利用') ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomField.status', array(
					'type'		=> 'radio',
					'options'	=> $customFieldConfig['status'][$blogContentId],
					'legend'	=> false,
					'separator'	=> '&nbsp;&nbsp;')) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomField.status') ?>
		</td>
	</tr>
<?php if($this->request->data['PetitBlogCustomFieldConfig']['use_name']): ?>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomField.name', $customFieldConfig['field_name'][$blogContentId]['name']) ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomField.name', array('type' => 'text', 'size' => 40, 'maxlength' => 255, 'counter' => true)) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomField.name') ?>
		</td>
	</tr>
<?php endif ?>
<?php if($this->request->data['PetitBlogCustomFieldConfig']['use_name_2']): ?>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomField.name_2', $customFieldConfig['field_name'][$blogContentId]['name_2']) ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomField.name_2', array('type' => 'text', 'size' => 40, 'maxlength' => 255, 'counter' => true)) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomField.name_2') ?>
		</td>
	</tr>
<?php endif ?>
<?php if($this->request->data['PetitBlogCustomFieldConfig']['use_content']): ?>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomField.content', $customFieldConfig['field_name'][$blogContentId]['textarea']) ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->ckeditor('PetitBlogCustomField.content', array(
				'width'		=> 'auto', 
				'height'	=> '200px', 
				'type'		=> 'simple',
				'enterBr'	=> @$siteConfig['editor_enter_br']
			)) ?>
			<?php // echo $this->BcForm->input('PetitBlogCustomField.content', array('type' => 'textarea', 'cols' => 40, 'rows' => 4)) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomField.content') ?>
		</td>
	</tr>
<?php endif ?>
<?php if($this->request->data['PetitBlogCustomFieldConfig']['use_radio']): ?>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomField.radio', $customFieldConfig['field_name'][$blogContentId]['radio']) ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomField.radio', array('type' => 'radio', 'options' => $customFieldConfig['radio'][$blogContentId])) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomField.radio') ?>
		</td>
	</tr>
<?php endif ?>
<?php if($this->request->data['PetitBlogCustomFieldConfig']['use_select']): ?>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomField.select', $customFieldConfig['field_name'][$blogContentId]['select']) ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomField.select', array('type' => 'select', 'options' => $customFieldConfig['select'][$blogContentId])) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomField.select') ?>
		</td>
	</tr>
<?php endif ?>
<?php if($this->request->data['PetitBlogCustomFieldConfig']['use_date']): ?>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomField.date', $customFieldConfig['field_name'][$blogContentId]['date']) ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->dateTimePicker('PetitBlogCustomField.date', array('size' => 12, 'maxlength' => 10), true) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomField.date') ?>
		</td>
	</tr>
<?php endif ?>

<?php if($this->request->data['PetitBlogCustomFieldConfig']['use_text_sub_1']): ?>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomField.text_sub_1', $customFieldConfig['field_name'][$blogContentId]['text_sub_1']) ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomField.text_sub_1', array('type' => 'text', 'size' => 60, 'maxlength' => 255, 'counter' => true)) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomField.text_sub_1') ?>
		</td>
	</tr>
<?php endif ?>
<?php if($this->request->data['PetitBlogCustomFieldConfig']['use_text_sub_2']): ?>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomField.text_sub_2', $customFieldConfig['field_name'][$blogContentId]['text_sub_2']) ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomField.text_sub_2', array('type' => 'text', 'size' => 60, 'maxlength' => 255, 'counter' => true)) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomField.text_sub_2') ?>
		</td>
	</tr>
<?php endif ?>
<?php if($this->request->data['PetitBlogCustomFieldConfig']['use_text_sub_3']): ?>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomField.text_sub_3', $customFieldConfig['field_name'][$blogContentId]['text_sub_3']) ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomField.text_sub_3', array('type' => 'text', 'size' => 60, 'maxlength' => 255, 'counter' => true)) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomField.text_sub_3') ?>
		</td>
	</tr>
<?php endif ?>
<?php if($this->request->data['PetitBlogCustomFieldConfig']['use_text_sub_4']): ?>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomField.text_sub_4', $customFieldConfig['field_name'][$blogContentId]['text_sub_4']) ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomField.text_sub_4', array('type' => 'text', 'size' => 60, 'maxlength' => 255, 'counter' => true)) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomField.text_sub_4') ?>
		</td>
	</tr>
<?php endif ?>
<?php if($this->request->data['PetitBlogCustomFieldConfig']['use_text_sub_5']): ?>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomField.text_sub_5', $customFieldConfig['field_name'][$blogContentId]['text_sub_5']) ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomField.text_sub_5', array('type' => 'text', 'size' => 60, 'maxlength' => 255, 'counter' => true)) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomField.text_sub_5') ?>
		</td>
	</tr>
<?php endif ?>
<?php if($this->request->data['PetitBlogCustomFieldConfig']['use_text_sub_6']): ?>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomField.text_sub_6', $customFieldConfig['field_name'][$blogContentId]['text_sub_6']) ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomField.text_sub_6', array('type' => 'text', 'size' => 60, 'maxlength' => 255, 'counter' => true)) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomField.text_sub_6') ?>
		</td>
	</tr>
<?php endif ?>
<?php if($this->request->data['PetitBlogCustomFieldConfig']['use_text_sub_7']): ?>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomField.text_sub_7', $customFieldConfig['field_name'][$blogContentId]['text_sub_7']) ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomField.text_sub_7', array('type' => 'text', 'size' => 60, 'maxlength' => 255, 'counter' => true)) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomField.text_sub_7') ?>
		</td>
	</tr>
<?php endif ?>
<?php if($this->request->data['PetitBlogCustomFieldConfig']['use_text_sub_8']): ?>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomField.text_sub_8', $customFieldConfig['field_name'][$blogContentId]['text_sub_8']) ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomField.text_sub_8', array('type' => 'text', 'size' => 60, 'maxlength' => 255, 'counter' => true)) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomField.text_sub_8') ?>
		</td>
	</tr>
<?php endif ?>
<?php if($this->request->data['PetitBlogCustomFieldConfig']['use_text_sub_9']): ?>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomField.text_sub_9', $customFieldConfig['field_name'][$blogContentId]['text_sub_9']) ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomField.text_sub_9', array('type' => 'text', 'size' => 60, 'maxlength' => 255, 'counter' => true)) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomField.text_sub_9') ?>
		</td>
	</tr>
<?php endif ?>
<?php if($this->request->data['PetitBlogCustomFieldConfig']['use_text_sub_10']): ?>
	<tr>
		<th class="col-head">
			<?php echo $this->BcForm->label('PetitBlogCustomField.text_sub_10', $customFieldConfig['field_name'][$blogContentId]['text_sub_10']) ?>
		</th>
		<td class="col-input">
			<?php echo $this->BcForm->input('PetitBlogCustomField.text_sub_10', array('type' => 'text', 'size' => 60, 'maxlength' => 255, 'counter' => true)) ?>
			<?php echo $this->BcForm->error('PetitBlogCustomField.text_sub_10') ?>
		</td>
	</tr>
<?php endif ?>

</table>
</div>
