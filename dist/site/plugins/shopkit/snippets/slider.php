<?php
/**
Slider plugin
$photos expects a collection of images or a comma-delimited list of filenames, e.g. from a `checkboxes` field.
*/

// Convert comma-separated list of filenames to image objects
$filenames = $photos->split();
if (is_array($filenames)) {
	$photos = page()->images()->filter(function($image) use ($filenames) {
		return in_array($image->filename(),$filenames);
	});
}

?>
<section>

	<?php $first = true ?>
	<?php foreach ($photos as $photo): ?>
		<input <?= ecco($first,'checked') ?> type="radio" name="thumbnail" id="<?= $photo->hash() ?>">
		<div class="slide">
			<img src="<?= $photo->thumb(['width' => 600, 'quality' => 100])->dataUri() ?>" title="<?= $photo->title() ?>"/>
		</div>
		<?php $first = false ?>
	<?php endforeach ?>

	<!-- Show thumbnails if there are multiple photos -->
	<?php if ($photos->count() > 1): ?>
		<ul class="thumbnails uk-padding-remove uk-margin-remove">
			<?php foreach ($photos as $photo): ?>
				<li>
					<label for="<?= $photo->hash() ?>">
						<img src="<?= $photo->thumb(['width' => 100, 'height' => 100, 'quality' => 80, 'crop' => true])->dataUri() ?>" title="<?= $photo->title() ?>"/>
					</label>
				</li>
			<?php endforeach ?>
		</ul>
	<?php endif ?>

</section>
