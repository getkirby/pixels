<!DOCTYPE html>
<html lang="en">
<head>
	<?php snippet('pixels/head') ?>
</head>
<body>

<div v-scope class="editor" @drop.prevent="onDrop">
	<?php snippet('pixels/toolbar') ?>

	<div class="editor-main">
		<?php snippet('pixels/exporter') ?>
		<?php snippet('pixels/canvas') ?>
	</div>
</div>

<?php snippet('pixels/foot') ?>

</body>
</html>
