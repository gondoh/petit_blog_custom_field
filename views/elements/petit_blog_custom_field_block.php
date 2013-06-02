<?php
/**
 * [PUBLISH] petit_blog_custom_field
 *
 * @copyright		Copyright 2013, materializing.
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
?>
<?php if(!empty($post)): ?>
<div id="PetitBlogCustomFieldBlock">
	<ul>
		<li>TEST</li>			
	</ul>
	<div>
		<?php echo $petitBlogCustomField->getPbcfName($post) ?>
		<br />
		<?php echo $petitBlogCustomField->getPbcfName2($post) ?>
	</div>
</div>
<?php else: ?>
<p>データがありません。</p>
<?php endif ?>
