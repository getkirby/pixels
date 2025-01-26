<?= js($plugin->asset('js/download.js')) ?>

<script type="module">
import { toPng } from '<?= $plugin->asset('js/html-to-image.js')->mediaUrl() ?>';

import {
	createApp,
	reactive
} from '<?= $plugin->asset('js/petite-vue.js')->mediaUrl() ?>';

const preventDefault = (e) => {
	e.stopPropagation();
	e.preventDefault();
};

window.addEventListener("dragenter", preventDefault, false);
window.addEventListener("dragover", preventDefault, false);
window.addEventListener("dragexit", preventDefault, false);
window.addEventListener("dragleave", preventDefault, false);
window.addEventListener("drop", preventDefault, false);

const colors = {
	white: "var(--color-white)",
	light: "var(--color-light)",
	gray: "#5d6166",
	dark: "var(--color-dark)",
	black: "var(--color-black)",
};

const positions = {
	topLeft: {
		y: "top",
		x: "left",
		arrow: "↘"
	},
	topCenter: {
		y: "top",
		x: "center",
		arrow: "↓"
	},
	topRight: {
		y: "top",
		x: "right",
		arrow: "↙"
	},
	centerLeft: {
		y: "center",
		x: "left",
		arrow: "→"
	},
	centerCenter: {
		y: "center",
		x: "center",
		arrow: "↔"
	},
	centerRight: {
		y: "center",
		x: "right",
		arrow: "←"
	},
	bottomLeft: {
		y: "bottom",
		x: "left",
		arrow: "↗"
	},
	bottomCenter: {
		y: "bottom",
		x: "center",
		arrow: "↑"
	},
	bottomRight: {
		y: "bottom",
		x: "right",
		arrow: "↖"
	},
};

const patterns = <?php echo json_encode($patterns) ?>;
const presets = JSON.parse(`<?= $presets ?>`);

const defaults = {
	background: colors.white,
	browser: false,
	color: "white",
	headline: null,
	image: "<?= $placeholder ?>",
	logo: false,
	mt: 0,
	mr: 0,
	mb: 0,
	ml: 0,
	pattern: null,
	position: positions.topCenter,
	preset: null,
	rounded: false,
	scale: 100,
	shadow: false,
	width: 1024,
	height: 512,
};

const settings = reactive({
	...defaults,
	...presets.social,
	get corners() {
		if (this.rounded === false) {
			return {};
		}

		let corners = {
			borderTopLeftRadius: "7px",
			borderTopRightRadius: "7px",
			borderBottomLeftRadius: "7px",
			borderBottomRightRadius: "7px",
		};

		if (this.mt === 0) {
			delete corners.borderTopLeftRadius;
			delete corners.borderTopRightRadius;
		}

		if (this.mr === 0) {
			delete corners.borderTopRightRadius;
			delete corners.borderBottomRightRadius;
		}

		if (this.ml === 0) {
			delete corners.borderTopLeftRadius;
			delete corners.borderBottomLeftRadius;
		}

		if (this.mb === 0) {
			delete corners.borderBottomLeftRadius;
			delete corners.borderBottomRightRadius;
		}

		return corners;

	},
	get fontWeight() {
		return this.color === "black" ? 400 : 300;
	}
});

createApp({
	colors,
	patterns,
	positions,
	presets,
	settings,
	isExporting: false,
	async exportImage() {
		this.isExporting = true;
		const canvas = document.querySelector(".editor-canvas");
		const dataUrl = await toPng(canvas);
		download(dataUrl, "pixels.png");
		this.isExporting = false;
	},
	onDrop(event) {
		if (!event.dataTransfer.files || event.dataTransfer.files.length === 0) {
			return;
		}

		this.selectFile(event.dataTransfer.files[0]);
	},
	onUpload(event) {
		if (!event.target.files || event.target.files.length === 0) {
			return;
		}

		this.selectFile(event.target.files[0]);
	},
	selectFile(file) {
		const reader = new FileReader();

		if (file.type.startsWith("image/") === false) {
			return false;
		}

		reader.onload = () => {
			this.settings.image = reader.result;
		};

		reader.readAsDataURL(file);
	},
	setPattern(event) {
		this.settings.pattern = event.target.value;
	},
	setPreset(event) {
		const newSettings = {
			...defaults,
			...presets[event.target.value],
		};

		for (const key in newSettings) {
			this.settings[key] = newSettings[key];
		}
	}
}).mount();
</script>
