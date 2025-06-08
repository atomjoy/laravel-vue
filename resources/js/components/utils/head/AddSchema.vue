<template></template>
<script setup>
import { onMounted, watch } from 'vue';

const props = defineProps({
	json: {
		type: String,
		default: null,
	},
});

onMounted(() => {
	load();
});

watch(
	() => props.json,
	(lang) => {
		load();
	}
);

function load() {
	if (props.json) {
		// console.log('Adding Schema', props.json);
		let arr = JSON.parse(props.json);
		const head = document.querySelector('head');
		const el = document.createElement('script');
		el.setAttribute('type', 'application/ld+json');
		el.setAttribute('id', 'structured-data');
		el.innerText = JSON.stringify(arr);
		head.appendChild(el);
	}
}

function getSchemaObject(id = '#structured-data') {
	let el = document.querySelector(id);
	let obj = JSON.parse(el.innerText);
	return obj;
}
</script>
