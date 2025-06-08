export default class Page {
	static prev(current_page) {
		let page = current_page - 1;
		if (page < 1) {
			page = 1;
		}
		return page;
	}

	static next(current_page, total_pages) {
		let page = current_page + 1;
		if (page > total_pages) {
			page = current_page;
		}
		return page;
	}
}
