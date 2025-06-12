import { ref, computed } from 'vue';
import { defineStore, storeToRefs } from 'pinia';
import router from '@/router';
import axios from 'axios';

export const useItemStore = defineStore('comments', () => {
	// State
	const error = ref(false);
	const message = ref(null);
	const item = ref({});
	let current_page = ref(1);
	let last_page = ref(1);
	let perpage = ref(5);
	let list = ref([]);

	// Getters
	const getItem = computed(() => item);
	// With value
	const getError = computed(() => error.value);
	const getMessage = computed(() => message.value);

	// Actions
	async function loadList(search = '') {
		let res = await axios.get('/web/api/comments?page=' + current_page.value + '&perpage=' + perpage.value + '&search=' + search);
		list.value = res?.data?.data ?? [];
		last_page.value = res?.data.paginate.total_pages ?? 1;
		current_page.value = res?.data.paginate.current_page ?? 1;
		router.replace({ query: { page: current_page.value } });
	}

	async function deleteItem(id) {
		try {
			if (confirm('Delete ?')) {
				let res = await axios.delete('/web/api/comments/' + id);
				setMessage(res);
				const row = document.querySelector('.panel_list_row_' + id);
				row.remove();
			}
		} catch (err) {
			setError(err);
		}
	}

	async function createItem(e) {
		try {
			let res = await axios.post('/web/api/comments', new FormData(e.target));
			setMessage(res);
			resetForm(e);
		} catch (err) {
			setError(err);
		}
		scrollTop();
	}

	async function updateItem(id, data) {
		try {
			data.append('_method', 'PATCH');
			let res = await axios.post('/web/api/comments/' + id, data);
			setMessage(res);
		} catch (err) {
			setError(err);
		}
		loadItem(id);
		scrollTop();
	}

	async function loadItem(id) {
		try {
			let res = await axios.get('/web/api/comments/' + id);
			item.value = res?.data;
		} catch (err) {
			setError(err);
		}
	}

	async function removeImage(id) {
		try {
			let res = await axios.get('/web/api/comments/remove/' + id);
			setMessage(res);
			loadItem(id);
		} catch (err) {
			setError(err);
		}
	}

	function setPerpage(value) {
		if (value < 5) {
			perpage.value = 5;
		}
		loadList();
	}

	function prevPage() {
		current_page.value--;
		if (current_page.value <= 0) {
			current_page.value = 1;
		}
		loadList();
	}

	function nextPage() {
		current_page.value++;
		if (current_page.value >= last_page.value) {
			current_page.value = last_page.value;
		}
		loadList();
	}

	function resetForm(e) {
		e.target.reset();
	}

	function clearError() {
		message.value = null;
		error.value = false;
	}

	function setMessage(res) {
		message.value = res?.data?.message;
		error.value = false;
	}

	function setError(err) {
		message.value = err?.response?.data?.message ?? err?.message ?? 'Ups! Invalid data.';
		error.value = true;
	}

	function updateMessage(msg) {
		message.value = msg;
	}

	function updateError(err = true) {
		error.value = err;
	}

	function scrollTop() {
		// Need html tag with overflow-y: scroll
		window.scrollTo({ top: 1, behavior: 'smooth' });
		// document.querySelector(id).scrollIntoView({behavior: 'smooth' });
	}

	return {
		message,
		error,
		item,
		current_page,
		last_page,
		perpage,
		list,
		getError,
		getMessage,
		getItem,
		resetForm,
		clearError,
		scrollTop,
		updateMessage,
		updateError,
		removeImage,
		createItem,
		loadItem,
		updateItem,
		loadList,
		deleteItem,
		setPerpage,
		prevPage,
		nextPage,
	};
});
