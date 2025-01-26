<?php

use Kirby\Cms\Page;
use Kirby\Cms\Plugin;
use Kirby\Filesystem\Dir;
use Kirby\Filesystem\F;

class PixelsPage extends Page
{
	public function patterns(): array
	{
		$patterns = [];

		foreach (Dir::index(dirname(__DIR__) . '/assets/patterns') as $pattern) {
			$name = F::name($pattern);
			$url  = $this->plugin()->asset('patterns/' . $pattern)->mediaUrl();
			$patterns[$name] = $url;
		}

		return $patterns;
	}

	public function plugin(): Plugin
	{
		return $this->kirby()->plugin('getkirby/pixels');
	}
}
