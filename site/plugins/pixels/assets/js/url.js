function sanitize(key, value) {
	if (key === "image") {
		try {
			return decodeURIComponent(value);
		} catch (e) {
			console.warn("Failed to decode image data URL:", e);
		}
	}
	if (value === "true" || value === "false") {
		return value === "true";
	}

	if (!isNaN(value)) {
		return Number(value);
	}

	return value;
}

export function parseQuery(settings) {
	// parse URL query parameters and override defaults
	const query = new URLSearchParams(window.location.search);
	const payload = {};

	// convert query parameters to appropriate types
	for (const [key, value] of query.entries()) {
		if (key in settings) {
			payload[key] = sanitize(key, value);
		}
	}

	return payload;
}
