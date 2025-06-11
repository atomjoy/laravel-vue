<!-- Runs only with vue 3.5 -->
<!-- <PaginateCustom :current_page="current_page" :last_page="last_page" @page="setPage" /> -->

<script setup>
import { onMounted, watchEffect } from 'vue';

const { current_page, last_page, offset } = defineProps({
	current_page: { type: Number, default: 1 },
	last_page: { type: Number, default: 10 },
	offset: { type: Number, default: 3 },
	btn_first: { type: String, default: 'First' },
	btn_last: { type: String, default: 'Last' },
	btn_next: { type: String, default: '>' },
	btn_prev: { type: String, default: '<' },
});

const emits = defineEmits(['page']);

let list = null;
let sublist = null;
let subpages = 2 * offset;

onMounted(() => {
	freshList();
	sliceList();
});

watchEffect(() => {
	freshList();
	sliceList();
});

function freshList() {
	list = [...Array(last_page + 1).keys()];
	list.shift();
}

function sliceList() {
	sublist = list.slice(startIndex(), endIndex());
}

function startIndex() {
	if (current_page > offset) {
		// > offset
		return current_page - offset - 1;
	} else {
		// < offset
		return 0;
	}
}

function endIndex() {
	if (current_page <= offset) {
		// <= offset
		return subpages;
	} else {
		// > offset
		return current_page + offset;
	}
}

function setPage(page) {
	emits('page', page);
}

function prevPage() {
	let page = current_page - 1;
	page = page < 1 ? 1 : page;
	setPage(page);
}

function nextPage() {
	let page = current_page + 1;
	page = page < last_page ? page : last_page;
	setPage(page);
}
</script>

<template>
	<div class="panel_list_links">
		<div class="panel_paginate_link" @click="prevPage" v-if="current_page > 1">{{ btn_prev }}</div>
		<div class="panel_paginate_link" @click="setPage(1)" v-if="current_page > 1">{{ btn_first }}</div>
		<div class="panel_paginate_link" :class="{ panel_paginate_link_active: current_page == i }" v-for="i in sublist" @click="setPage(i)">{{ i }}</div>
		<div class="panel_paginate_link" @click="setPage(last_page)" v-if="current_page < last_page">{{ btn_last }}</div>
		<div class="panel_paginate_link" @click="nextPage" v-if="current_page < last_page">{{ btn_next }}</div>
	</div>
</template>

<style>
.panel_list_links {
	float: left;
	width: 100%;
	margin-block: 20px;
	box-sizing: border-box;
}
.panel_paginate_link {
	float: left;
	font-size: 14px;
	min-width: 40px;
	padding: 9px 15px;
	margin-right: 10px;
	border: 1px solid #f1f1f1;
	border-radius: 10px;
	text-align: center;
	cursor: pointer;
	user-select: none;
}
.panel_paginate_link:hover {
	color: #09f;
}
.panel_paginate_link_active {
	border: 1px solid #09f;
	color: #09f;
	font-weight: 600;
}
</style>
