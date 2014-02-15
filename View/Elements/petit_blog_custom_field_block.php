<?php
/**
 * [PUBLISH] PetitBlogCustomField
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			PetitBlogCustomField
 * @license			MIT
 */
?>
<?php if (!empty($post)): ?>
	<?php if ($petitBlogCustomField->judgeStatus($post)): ?>
<div id="PetitBlogCustomFieldBlock">
	<div class="post-body">
		<dl>
			<dt>カスタムフィールド</dt>
			<dd><?php echo $petitBlogCustomField->getPbcfName($post) ?></dd>
			<dd><?php echo $petitBlogCustomField->getPbcfName2($post) ?></dd>
			<dd><?php echo $petitBlogCustomField->getPbcfContent($post) ?></dd>
			<dd><?php echo $petitBlogCustomField->getPbcfRadio($post, array('invisible' => true)) ?></dd>
			<dd><?php echo $petitBlogCustomField->getPbcfSelect($post) ?></dd>
			<dd><?php echo $petitBlogCustomField->getPbcfDate($post) ?></dd>
		</dl>
	</div>
</div>
	<?php endif ?>
<?php else: ?>
<p>データがありません。</p>
<?php endif ?>
