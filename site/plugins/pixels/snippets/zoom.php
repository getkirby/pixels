<div class="zoom">
	<button type="button" @click="settings.zoom -= 0.1">
		<?= icon('zoom-out') ?>
	</button>
  <input type="range" v-model="settings.zoom" min="0.5" max="1.5" step="0.001">
	<button type="button" @click="settings.zoom += 0.1">
		<?= icon('zoom-in') ?>
	</button>
</div>
