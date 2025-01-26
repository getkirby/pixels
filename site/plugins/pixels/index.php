<?php

use Kirby\Cms\App;

load([
	'pixelspage' => __DIR__ . '/models/pixels.php'
]);

require __DIR__ . '/helpers/html.php';

App::plugin(
	name: 'getkirby/pixels',
	extends: [
		'controllers' => [
			'pixels' => require __DIR__ . '/controllers/pixels.php'
		],
		'pageModels' => [
			'pixels' => PixelsPage::class
		],
		'snippets' => [
			'pixels/canvas'      => __DIR__ . '/snippets/canvas.php',
			'pixels/exporter'    => __DIR__ . '/snippets/exporter.php',
			'pixels/foot'        => __DIR__ . '/snippets/foot.php',
			'pixels/group-label' => __DIR__ . '/snippets/group-label.php',
			'pixels/head'        => __DIR__ . '/snippets/head.php',
			'pixels/toolbar'     => __DIR__ . '/snippets/toolbar.php'
		],
		'templates' => [
			'pixels' => __DIR__ . '/templates/pixels.php'
		]
	]
);
