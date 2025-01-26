<?php

use Kirby\Filesystem\F;

return function (PixelsPage $page) {
	return [
		'plugin'      => $plugin = $page->plugin(),
		'presets'     => F::read($plugin->asset('presets.json')->root()),
		'patterns'    => $page->patterns(),
		'placeholder' => $plugin->asset('placeholder.png')->mediaUrl()
	];
};
