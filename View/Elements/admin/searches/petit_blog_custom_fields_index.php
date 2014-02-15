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
<?php echo $this->BcForm->create('PetitBlogCustomField', array('url' => array('action' => 'index'))) ?>
<p>
	<span>
		<?php echo $this->BcForm->label('PetitBlogCustomField.name', 'カスタムネーム') ?>
		&nbsp;<?php echo $this->BcForm->input('PetitBlogCustomField.name', array('type' => 'text', 'size' => '30')) ?>
	</span>
	<br />
	<span>
		<?php echo $this->BcForm->label('PetitBlogCustomField.blog_content_id', 'ブログ') ?>
		&nbsp;<?php echo $this->BcForm->input('PetitBlogCustomField.blog_content_id', array('type' => 'select', 'options' => $blogContentDatas)) ?>
	</span>
	<span>
		<?php echo $this->BcForm->label('PetitBlogCustomField.status', '利用状態') ?>
		&nbsp;<?php echo $this->BcForm->input('PetitBlogCustomField.status', array('type' => 'select', 'options' => $this->BcText->booleanMarkList(), 'empty' => '指定なし')) ?>
	</span>
</p>
<div class="button">
	<?php echo $this->BcForm->submit('admin/btn_search.png', array('alt' => '検索', 'class' => 'btn'), array('div' => false, 'id' => 'BtnSearchSubmit')) ?>
</div>
<?php echo $this->BcForm->end() ?>
