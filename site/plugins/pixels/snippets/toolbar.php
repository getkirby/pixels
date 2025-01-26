<nav class="editor-toolbar">
	<div v-cloak>
		<div class="field mb-6">
			<label for="presets" class="label">Presets</label>
			<div class="select">
				<select id="presets" :value="settings.preset" @input="setPreset">
					<option
						v-for="(preset, id) in presets"
						:value="id"
					>
						{{ preset.label }}
					</option>
				</select>
			</div>
		</div>

		<details class="editor-group" open>
			<?php snippet('pixels/group-label', ['label' => 'Text']) ?>

			<div>
				<div class="field mb-6">
					<label>
						<span class="label">Headline</span>
						<input
							class="input"
							id="headline"
							type="text"
							v-model="settings.headline"
						>
					</label>
				</div>

				<div class="columns" style="--columns: 2; --gap: var(--spacing-1)">
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

							<input
								ref="customTextColor"
								type="color"
								:aria-selected="['white', 'black'].includes(settings.color) === false"
								value="#63a1de"
								class="color-custom"
								@input="settings.color = $event.target.value"
							/>
						</div>
					</div>

					<div class="field">
						<label>
							<span class="label">Logo</span>
							<div class="checkbox">
								<input type="checkbox" name="logo" v-model="settings.logo">
							</div>
						</label>
					</div>
				</div>
			</div>
		</details>

		<details class="editor-group">
			<?php snippet('pixels/group-label', ['label' => 'Image']) ?>

			<div>
				<div class="field mb-6">
					<div class="upload">
						<label>
							Select …
							<input type="file" accept="image/*" @input="onUpload">
						</label>
					</div>
				</div>

				<div class="columns mb-6" style="--columns: 3; --gap: var(--spacing-1)">
					<div class="field">
						<label>
							<span class="label">Shadow</span>

							<div class="checkbox">
								<input type="checkbox" name="shadow" v-model="settings.shadow">
							</div>
						</label>
					</div>
					<div class="field">
						<label>
							<span class="label">Rounded</span>
							<div class="checkbox">
								<input type="checkbox" name="rounded" v-model="settings.rounded">
							</div>
						</label>
					</div>
					<div class="field">
						<label>
							<span class="label">Browser</span>
							<div class="checkbox">
								<input type="checkbox" name="browser" v-model="settings.browser">
							</div>
						</label>
					</div>
				</div>
				<div class="field mb-6">
					<label class="label">Align image</label>
					<ul class="inputs columns" style="--columns: 3">
						<li v-for="position in positions">
							<label><input type="radio" v-model="settings.position" :value="position"> {{ position.arrow }}</label>
						</li>
					</ul>
				</div>
				<div class="field">
					<label class="label">Scale image</label>
					<div class="range">
						<input type="range" v-model="settings.scale" min="100" max="250">
					</div>
				</div>
			</div>
		</details>

		<details class="editor-group">
			<?php snippet('pixels/group-label', ['label' => 'Background']) ?>

			<div>
				<div class="field mb-6">
					<label class="label">Background color</label>
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
						<input
							type="color"
							:aria-selected="Object.values(colors).includes(settings.background) === false"
							value="#d9e8f7"
							class="color-custom"
							@input="settings.background = $event.target.value"
						/>
					</div>
				</div>
				<div class="field">
					<label>
						<span class="label">
							Pattern
							<button
								v-if="settings.pattern !== ''"
								type="button"
								@click="settings.pattern = ''"
								class="editor-patterns-cancel"
							>
								<?= icon('cancel-small') ?>
							</button>
						</span>

						<div class="select">
							<select @input="settings.pattern = $event.target.value">
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
					</label>
				</div>
			</div>
		</details>

		<details class="editor-group">
			<?php snippet('pixels/group-label', ['label' => 'Format']) ?>

			<div>
				<div class="field mb-6">
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
					<div class="columns" style="--columns: 4; --gap: var(--spacing-1)">
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
			</div>
		</details>

		<button class="btn" @click="exportImage">
			<?= icon('download') ?> Export
		</button>
	</div>
</nav>
