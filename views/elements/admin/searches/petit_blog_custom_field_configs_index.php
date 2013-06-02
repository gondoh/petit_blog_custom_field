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
<?php echo $bcForm->create('PetitBlogCustomFieldConfigs', array('url' => array('action' => 'index'))) ?>
<p>
	<span>
		<?php echo $bcForm->label('PetitBlogCustomFieldConfigs.blog_content_id', 'ブログ') ?>
		&nbsp;<?php echo $bcForm->input('PetitBlogCustomFieldConfigs.blog_content_id', array('type' => 'select', 'options' => $blogContentDatas)) ?>
	</span>
</p>
<div class="button">
	<?php echo $bcForm->submit('admin/btn_search.png', array('alt' => '検索', 'class' => 'btn'), array('div' => false, 'id' => 'BtnSearchSubmit')) ?>
</div>
<?php echo $bcForm->end() ?>
