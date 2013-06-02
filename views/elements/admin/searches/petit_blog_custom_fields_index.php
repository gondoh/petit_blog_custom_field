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
<?php echo $bcForm->create('PetitBlogCustomField', array('url' => array('action' => 'index'))) ?>
<p>
	<span>
		<?php echo $bcForm->label('PetitBlogCustomField.name', 'プチ・カスタムネーム') ?>
		&nbsp;<?php echo $bcForm->input('PetitBlogCustomField.name', array('type' => 'text', 'size' => '30')) ?></span>
	<span>
		<?php echo $bcForm->label('PetitBlogCustomField.blog_content_id', 'ブログ') ?>
		&nbsp;<?php echo $bcForm->input('PetitBlogCustomField.blog_content_id', array('type' => 'select', 'options' => $blogContentDatas)) ?>
	</span>
</p>
<div class="button">
	<?php echo $bcForm->submit('admin/btn_search.png', array('alt' => '検索', 'class' => 'btn'), array('div' => false, 'id' => 'BtnSearchSubmit')) ?>
</div>
<?php echo $bcForm->end() ?>
