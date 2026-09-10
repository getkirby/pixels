<div class="canvas-wrapper" :style="{
	width: settings.width + 'px',
	height: settings.height + 'px'
}">
	<div v-cloak class="canvas" :data-preset="settings.preset" :style="{
		backgroundColor: settings.background,
		width: settings.width + 'px',
		height: settings.height + 'px',
		color: settings.color,
		transform: 'scale(' +  settings.zoom + ')'
	}">

		<div
			v-if="settings.pattern"
			class="canvas-pattern"
			:style="{ backgroundImage: 'url(' + patterns[settings.pattern] + ')' }"
		></div>

		<header class="canvas-header">
			<div
				class="canvas-headline"
				:style="{
					color: settings.color,
					fontWeight: settings.fontWeight
				}"
				spellcheck="false"
				contenteditable="true"
				@input="settings.headline = $event.target.innerText"
			>
				{{ settings.headline }}
			</div>
			<div v-if="settings.logo" class="canvas-logo"><?= $logo ?></div>
		</header>

		<div class="canvas-image" :data-rounded="settings.rounded" :data-shadow="settings.shadow" :style="{
				top: settings.mt + 'rem',
				right: settings.mr + 'rem',
				bottom: settings.mb + 'rem',
				left: settings.ml + 'rem',
				...settings.corners,
			}">
			<template v-if="settings.browser">
				<div class="canvas-browser bg-black flex items-center" style="--gap: .375rem; padding: .625rem">
					<svg width="10" height="10">
						<circle fill="var(--color-gray-700)" cx="5" cy="5" r="5" />
					</svg>
					<svg width="10" height="10">
						<circle fill="var(--color-gray-700)" cx="5" cy="5" r="5" />
					</svg>
					<svg width="10" height="10">
						<circle fill="var(--color-gray-700)" cx="5" cy="5" r="5" />
					</svg>
				</div>
			</template>
			<template v-if="settings.image">
				<div class="canvas-image-wrapper" @dblclick="selectImage">
					<img
						:data-y="settings.position.y"
						:data-x="settings.position.x"
						:src="settings.image"
						:style="{ width: settings.scale + '%' }"
						decoding="sync"
					>
				</div>
			</template>
		</div>
	</div>
</div>
