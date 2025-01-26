<div v-cloak class="editor-canvas" :data-preset="settings.preset" :style="{
		backgroundColor: settings.background,
		width: settings.width + 'px',
		height: settings.height + 'px',
		color: settings.color
	}">

	<div
		v-if="settings.pattern"
		class="editor-pattern"
		:style="{ backgroundImage: 'url(' + patterns[settings.pattern] + ')' }"
	></div>

	<header class="editor-header">
		<div
			class="editor-headline"
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
		<div v-if="settings.logo" class="editor-logo"><?= $logo ?></div>
	</header>

	<div class="editor-image" :data-rounded="settings.rounded" :data-shadow="settings.shadow" :style="{
			top: settings.mt + 'rem',
			right: settings.mr + 'rem',
			bottom: settings.mb + 'rem',
			left: settings.ml + 'rem',
			...settings.corners,
		}">
		<template v-if="settings.browser">
			<div class="editor-browser bg-black flex items-center" style="--gap: .375rem; padding: .625rem">
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
			<div class="editor-image-wrapper">
				<img :data-y="settings.position.y" :data-x="settings.position.x" :src="settings.image" :style="{ width: settings.scale + '%' }">
			</div>
		</template>
	</div>
</div>
