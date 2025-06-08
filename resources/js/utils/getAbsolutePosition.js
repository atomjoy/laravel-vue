export default function getAbsolutePosition(element) {
	const rect = element.getBoundingClientRect();

	return {
		top: rect.top + window.scrollY,
		left: rect.left + window.scrollX,
		bottom: rect.bottom + window.scrollY,
		right: rect.right + window.scrollX,
	};
}
