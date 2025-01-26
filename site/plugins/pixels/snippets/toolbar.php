<nav class="editor-toolbar">
	<div v-cloak>
		<div class="field">
			<label class="label">Presets</label>
			<div class="select">
				<select @input="setPreset" v-model="settings.preset">
					<option
						v-for="(preset, id) in presets"
						:value="id"
					>
						{{ preset.label }}
					</option>
				</select>
			</div>
		</div>
		<div class="field">
			<label class="label">Headline</label>
			<input class="input" type="text" v-model="settings.headline">
		</div>
		<div class="columns mb-3" style="--columns: 2; --gap: var(--spacing-1)">
			<div class="field">
				<label class="label">Logo</label>
				<div class="checkbox">
					<input type="checkbox" name="logo" v-model="settings.logo">
				</div>
			</div>
			<div class="field">
				<label class="label">Browser</label>
				<div class="checkbox">
					<input type="checkbox" name="browser" v-model="settings.browser">
				</div>
			</div>
		</div>
		<div class="field">
			<label class="label">Image</label>
			<div class="upload">
				<p>Select …</p>
				<input type="file" accept="image/*" @input="onUpload">
			</div>
		</div>
		<div class="field">
			<label class="label">Image scale</label>
			<div class="range">
				<input type="range" v-model="settings.scale" min="100" max="250">
			</div>
		</div>
		<div class="field">
			<label class="label">Image alignment</label>
			<ul class="inputs columns" style="--columns: 3">
				<li v-for="position in positions">
					<label><input type="radio" v-model="settings.position" :value="position"> {{ position.arrow }}</label>
				</li>
			</ul>
		</div>
		<div class="columns" style="--columns: 2; --gap: var(--spacing-1)">
			<div class="field">
				<label class="label">Shadow</label>
				<div class="checkbox">
					<input type="checkbox" name="shadow" v-model="settings.shadow">
				</div>
			</div>
			<div class="field">
				<label class="label">Rounded corners</label>
				<div class="checkbox">
					<input type="checkbox" name="rounded" v-model="settings.rounded">
				</div>
			</div>
		</div>
		<div class="field">
			<label class="label">Background</label>
			<div class="colors">
				<button
					v-for="color in colors"
					type="button"
					:aria-selected="settings.background === color"
					:style="'--color:' + color"
					@click="settings.background = color"
				>
					<span></span>
				</button>
			</div>
		</div>
		<div class="field">
			<label class="label">Pattern</label>
			<div class="select">
				<select @input="setPattern">
					<option value="">
						-
					</option>
					<option
						v-for="(patternUrl, pattern) in patterns"
						:value="pattern"
						:selected="pattern === settings.pattern"
					>
						{{ pattern }}
					</option>
				</select>
			</div>
		</div>
		<div class="field">
			<label class="label">Text Color</label>
			<div class="colors">
				<button
					type="button"
					:aria-selected="settings.color === 'white'"
					:style="'--color: white'"
					@click="settings.color = 'white'"
				>
					<span></span>
				</button>
				<button
					type="button"
					:aria-selected="settings.color === 'black'"
					:style="'--color: black'"
					@click="settings.color = 'black'"
				>
					<span></span>
				</button>
			</div>
		</div>
		<div class="field">
			<label class="label">Dimensions</label>
			<div class="columns" style="--columns: 2; --gap: var(--spacing-1)">
				<input
					class="input"
					type="number"
					min="100"
					v-model="settings.width"
					placeholder="width"
				>
				<input
					class="input"
					type="number"
					min="100"
					v-model="settings.height"
					placeholder="height"
				>
			</div>
		</div>
		<div class="field">
			<label class="label">Margins</label>
			<div class="columns" style="--columns: 2; --gap: var(--spacing-1)">
				<input
					class="input"
					type="number"
					min="0"
					v-model="settings.mt"
					placeholder="top"
				>
				<input
					class="input"
					type="number"
					min="0"
					v-model="settings.mr"
					placeholder="right"
				>
				<input
					class="input"
					type="number"
					min="0"
					v-model="settings.mb"
					placeholder="bottom"
				>
				<input
					class="input"
					type="number"
					min="0"
					v-model="settings.ml"
					placeholder="left"
				>
			</div>
		</div>
		<button class="btn" @click="exportImage">
			<?= icon('download') ?> Export
		</button>
	</div>
</nav>
