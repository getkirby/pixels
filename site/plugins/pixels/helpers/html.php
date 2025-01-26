<?php

if (function_exists('icon') === false) {
	function icon(string $name): string|false
	{
		// prefer custom icon files from assets folder
		if ($svg = svg('assets/icons/' . $name . '.svg')) {
			return $svg;
		}

		// fall back to Panel icons
		static $panel;
		$panel ??= svg('kirby/panel/dist/img/icons.svg');

		if ($panel) {
			// find the icon in the Panel sprite
			if (preg_match('/<symbol[^>]*id="icon-' . $name . '"[^>]*viewBox="(.*?)"[^>]*>(.*?)<\/symbol>/s', $panel, $matches)) {

				//  resolve <use> tags to full inline SVG
				if (preg_match('/<use href="#icon-(.*?)"[^>]*?>/s', $matches[2], $use)) {
					return icon($use[1]);
				}

				// return the icon with the correct viewBox
				return '<svg data-type="' . $name . '" xmlns="http://www.w3.org/2000/svg" viewBox="' . $matches[1] . '">' . $matches[2] . '</svg>';
			}
		}

		return false;
	}
}
