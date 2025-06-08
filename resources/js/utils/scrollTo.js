export default function scrollTo(id = '.page_contact') {
	const el = document.querySelector(id);
	const rect = el.getBoundingClientRect();
	window.scrollTo({ top: rect.top + window.scrollY - 50, behavior: 'smooth' });
}
