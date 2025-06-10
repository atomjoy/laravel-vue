<!-- <Paginate @current_page="console.log($event)" /> -->

<script setup>
import { ref } from 'vue';

const props = defineProps({
	sub_pages: { type: Number, default: 5 },
	current_page: { type: Number, default: 1 },
	last_page: { type: Number, default: 10 },
});

const emits = defineEmits(['current_page']);

const subpages = props.sub_pages < 4 ? 4 : props.sub_pages; // min 4
const last_page = props.last_page < 1 ? 1 : props.last_page;
const page = props.current_page < 1 ? 1 : props.current_page;
const current_page = ref(page);
const maxsubpage = last_page - subpages;
const list = [...Array(last_page + 1).keys()];
let sublist = list.slice(current_page.value, current_page.value + subpages);

function setPage(i) {
	current_page.value = i;
	emits('current_page', current_page.value);

	if (current_page.value <= 3) {
		sublist = list.slice(1, subpages + 1);
	} else if (current_page.value > maxsubpage + 3) {
		sublist = list.slice(-subpages);
	} else {
		sublist = list.slice(current_page.value - 2, current_page.value + (subpages - 2));
	}
}

function prevPage() {
	setPage(current_page.value - 1);
}

function nextPage() {
	setPage(current_page.value + 1);
}

function firstPage() {
	setPage(1);
}

function lastPage() {
	setPage(last_page);
}
</script>

<template>
	<div class="panel_list_links" v-if="list.length > 0">
		<div class="panel_paginate_link" @click="prevPage" v-if="current_page > 1"><</div>
		<div class="panel_paginate_link" @click="firstPage" v-if="current_page > 1">FIRST</div>
		<div class="panel_paginate_link" :class="{ panel_paginate_link_active: current_page == i }" v-for="i in sublist" @click="setPage(i)">{{ i }}</div>
		<div class="panel_paginate_link" @click="lastPage" v-if="current_page < last_page">LAST</div>
		<div class="panel_paginate_link" @click="nextPage" v-if="current_page < last_page">></div>
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
