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
<?php echo $bcForm->create('PetitBlogCustomFieldConfig', array('action' => 'first')) ?>
<?php echo $bcForm->input('PetitBlogCustomFieldConfig.active', array('type' => 'hidden', 'value' => '1')) ?>
<table cellpadding="0" cellspacing="0" class="form-table section" id="ListTable">
	<tr>
		<th class="col-head">
			はじめに<br />お読み下さい。
		</th>
		<td class="col-input">
			<strong>プチ・ブログカスタムフィールド設定データ作成では、各ブログ用のプチ・カスタムフィールド設定データを作成します。</strong>
			<ul>
				<li>プチ・カスタムフィールド設定データがないブログ用のデータのみ作成します。</li>
			</ul>
		</td>
	</tr>
</table>

<div class="submit">
	<?php echo $bcForm->submit('作成する', array(
		'div' => false,
		'class' => 'btn-red button',
		'id' => 'BtnSubmit',
		'onClick'=>"return confirm('プチ・カスタムフィールド設定データの作成を行いますが良いですか？')")) ?>
</div>
<?php echo $bcForm->end() ?>
