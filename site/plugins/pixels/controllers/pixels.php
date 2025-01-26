<?php

use Kirby\Filesystem\F;

return function (PixelsPage $page) {
	return [
		'plugin'      => $plugin = $page->plugin(),
		'logo'        => svg($plugin->asset('logo.svg')->root()),
		'presets'     => F::read($plugin->asset('presets.json')->root()),
		'patterns'    => $page->patterns(),
		'placeholder' => $plugin->asset('placeholder.png')->mediaUrl()
	];
};
