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
<?php echo $this->BcForm->create('PetitBlogCustomField', array('url' => array('action' => 'batch'))) ?>
<table cellpadding="0" cellspacing="0" class="list-table" id="ListTable">
	<tr>
		<th class="col-head" style="width:20%;">はじめに<br />お読み下さい。</th>
		<td class="col-input">
			<strong>プチ・ブログカスタムフィールド一括設定では、ブログ別にプチ・カスタムフィールドを一括で登録できます。</strong>
			<ul>
				<li>プチ・カスタムフィールドの登録がないブログ記事用のプチ・カスタムフィールドを登録します。</li>
			</ul>
		</td>
	</tr>
	<tr>
		<th class="col-head">ブログの指定</th>
		<td class="col-input">
			<?php if($blogContentDatas): ?>
				<?php echo $this->BcForm->input('PetitBlogCustomField.blog_content_id', array('type' => 'select', 'options' => $blogContentDatas)) ?>
			<?php else: ?>
				ブログがないために設定できません。
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th class="col-head">プチ・カスタムフィールドの未登録状況</th>
		<td class="col-input">
			<ul>
			<?php foreach ($registerd as $value): ?>
				<li><?php echo $value['name'] ?>：
					<span class="large"><strong><?php echo $value['count'] ?> 件</strong></span></li>
			<?php endforeach ?>
			</ul>
		</td>
	</tr>
</table>

<div class="submit">
	<?php if($blogContentDatas): ?>
		<?php echo $this->BcForm->submit('一括設定する', array(
			'div' => false,
			'class' => 'btn-red button',
			'id' => 'BtnSubmit',
			'onClick'=>"return confirm('プチ・カスタムフィールドの一括設定を行いますが良いですか？')")) ?>
	<?php else: ?>
		ブログがないために設定できません。
	<?php endif ?>
</div>
<?php echo $this->BcForm->end() ?>
