import { defineStore } from 'pinia';
import { ref } from 'vue';
import axios from 'axios';

export const useNotifyStore = defineStore('notify', () => {
	// State
	const items = ref(new Map());
	let page = ref(1);
	let unread = ref(0);
	let open = ref(false);

	// Actions
	function toggleOpen() {
		open.value = !open.value;
	}

	async function loadPage() {
		try {
			if (page < 1) page = 1;
			let res = await axios.get(
				'/web/api/admin/notifications/page/' + page.value
			);
			let all = res.data.notifications ?? [];
			all.forEach((n) => {
				if (!items.value.has(n.id)) {
					items.value.set(n.id, n);
				}
			});
			unread.value = res.data.unread;
			page.value++;
		} catch (err) {
			logError(err);
		}
	}

	async function markAsReadAll() {
		try {
			let res = await axios.get('/web/api/admin/notifications/readall');
			items.value.clear();
			page.value = 1;
			loadPage();
		} catch (err) {
			logError(err);
		}
	}

	async function deleteNotification(id) {
		try {
			let res = await axios.get(
				'/web/api/admin/notifications/delete/' + id
			);
			items.value.delete(id);
		} catch (err) {
			logError(err);
		}
	}

	async function toggleNotification(id) {
		try {
			let res = await axios.get(
				'/web/api/admin/notifications/toggle/' + id
			);
		} catch (err) {
			logError(err);
		}
	}

	function logError(err) {
		if (err.response) {
			console.log('Exception', err.response.data);
		} else if (err.request) {
			console.log('Error request', err.request);
		} else {
			console.log('Error', err.message);
			console.log('Error config', err.config);
		}
	}

	return {
		loadPage,
		markAsReadAll,
		deleteNotification,
		toggleNotification,
		toggleOpen,
		unread,
		items,
		page,
		open,
	};
});
