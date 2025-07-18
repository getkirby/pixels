<script type="module">
import { toPng } from '<?= $plugin->asset('js/html-to-image.js')->mediaUrl() ?>';
import { createApp, reactive } from '<?= $plugin->asset('js/petite-vue.js')->mediaUrl() ?>';
import { parseQuery } from '<?= $plugin->asset('js/url.js')->mediaUrl() ?>';

const patterns = <?php echo json_encode($patterns) ?>;
const presets = JSON.parse(`<?= $presets ?>`);
const colors = {
	white: "var(--color-white)",
	light: "var(--color-light)",
	gray: "#5d6166",
	dark: "var(--color-dark)",
	black: "var(--color-black)",
};

const positions = {
	topLeft:      { y: "top",    x: "left",   arrow: "↘" },
	topCenter:    { y: "top",    x: "center", arrow: "↓" },
	topRight:     { y: "top",    x: "right",  arrow: "↙" },
	centerLeft:   { y: "center", x: "left",   arrow: "→" },
	centerCenter: { y: "center", x: "center", arrow: "↔" },
	centerRight:  { y: "center", x: "right",  arrow: "←" },
	bottomLeft:   { y: "bottom", x: "left",   arrow: "↗" },
	bottomCenter: { y: "bottom", x: "center", arrow: "↑" },
	bottomRight:  { y: "bottom", x: "right",  arrow: "↖" },
};

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
	zoom: 1,
	get corners() {
		const corners = {};

		if (this.rounded === true) {
			if (this.mt !== 0 && this.ml !== 0) {
				corners.borderTopLeftRadius = "7px";
			}
			if (this.mt !== 0 && this.mr !== 0) {
				corners.borderTopRightRadius = "7px";
			}
			if (this.mb !== 0 && this.ml !== 0) {
				corners.borderBottomLeftRadius = "7px";
			}
			if (this.mb !== 0 && this.mr !== 0) {
				corners.borderBottomRightRadius = "7px";
			}
		}

		return corners;

	},
	get fontWeight() {
		return this.color === "black" ? 400 : 300;
	}
});

// create vue-petite app
createApp({
	colors,
	patterns,
	positions,
	presets,
	settings,
	isExporting: false,
	async download() {
		this.isExporting = true;
		const canvas = document.querySelector(".canvas");
		const zoom = this.settings.zoom;
		this.settings.zoom = 1;
		const link = document.createElement("a");
		link.href = await toPng(canvas);
		link.download = "pixels.png";
		link.click();
		this.settings.zoom = zoom;
		this.isExporting = false;
	},
	importJSON(file) {
		const reader = new FileReader();
		reader.onload = () => {
			this.settings = JSON.parse(reader.result);
		};
		reader.readAsText(file);
	},
	init() {
		this.setPreset('social');

		// integrate settings passed in URL
		this.settings = {
			...this.settings,
			...parseQuery(this.settings),
		};
	},
	loadImage(file) {
		const reader = new FileReader();

		if (file.type.startsWith("image/") === false) {
			return false;
		}

		reader.onload = () => {
			this.settings.image = reader.result;
		};

		reader.readAsDataURL(file);
	},
	onDrop(event) {
		if (!event.dataTransfer.files || event.dataTransfer.files.length === 0) {
			return;
		}

		const file = event.dataTransfer.files[0];

		if (file.name.endsWith(".json")) {
			return this.importJSON(file)
		}

		this.loadImage(file);
	},
	onUpload(event) {
		if (!event.target.files || event.target.files.length === 0) {
			return;
		}

		this.loadImage(event.target.files[0]);
	},
	selectImage() {
		const input = document.querySelector(".upload input");
		input?.click();

	},
	setPreset(preset) {
		const newSettings = {
			...defaults,
			...presets[preset],
		};

		// select random pattern
		if (newSettings.pattern === true) {
			newSettings.pattern = Object.keys(patterns)[
				Object.keys(patterns).length * Math.random() << 0
			];
		}

		for (const key in newSettings) {
			this.settings[key] = newSettings[key];
		}
	}
}).mount();

// handle toolbar groups toggling
const groups = document.querySelectorAll(".toolbar-group");

function toggleGroups(event) {
  if (event.target.open) {
		for (const group of groups) {
			group.open = group === event.target;
		}
	}
}

// Add toggle listeners.
for (const group of groups) {
  group.addEventListener("toggle", toggleGroups);
}

// Add listener for export keyboard shortcut
document.addEventListener("keydown", (event) => {
  if ((event.ctrlKey || event.metaKey) && event.key === "s") {
    event.preventDefault();
		const data = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(settings));
		const link = document.createElement("a");
		link.href = data;
		link.download = "pixels.json";
		link.click();
  }
});

// prevent default drag events
const preventDefault = (e) => {
	e.stopPropagation();
	e.preventDefault();
};

window.addEventListener("dragenter", preventDefault, false);
window.addEventListener("dragover", preventDefault, false);
window.addEventListener("dragexit", preventDefault, false);
window.addEventListener("dragleave", preventDefault, false);
window.addEventListener("drop", preventDefault, false);
</script>
