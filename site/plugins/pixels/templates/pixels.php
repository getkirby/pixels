<!DOCTYPE html>
<html lang="en">
<head>
	<?php snippet('pixels/head') ?>
</head>

<body>
	<div v-scope class="pixels" @drop.prevent="onDrop">
		<?php snippet('pixels/toolbar') ?>

		<main @mounted="init">
			<?php snippet('pixels/exporter') ?>
			<?php snippet('pixels/canvas') ?>
			<?php snippet('pixels/zoom') ?>
		</main>
	</div>

	<?php snippet('pixels/script') ?>
</body>
</html>
