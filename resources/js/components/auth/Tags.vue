<script setup>
import { ref } from 'vue';

const model = defineModel();
const input = ref(null);
const tag = ref('');

function add() {
	if (tag.value.length > 40) {
		alert('Max 40 characters');
		return;
	}
	if (new RegExp('^[a-z0-9]+(?:-[a-z0-9]+)*$').test(tag.value)) {
		model.value.push(tag.value);
		tag.value = '';
	} else {
		alert('Invalid tag');
	}
}

function del(slug) {
	if (confirm('Delete?')) {
		model.value = model.value.filter((i) => i !== slug);
	}
}
</script>

<template>
	<div class="input_tag_wrapper">
		<div class="input_tag_list" @click="input.focus()">
			<input ref="input" v-model="tag" type="text" name="tag" class="input_tag_input" @blur="input.value = ''" @keydown.enter.prevent="add" :placeholder="$t('Add tag-slug lower-case and hit enter')" />
			<input v-model="model" type="hidden" name="tags[]" />
			<div class="input_tag_item" v-for="tag in model" @click="del(tag)" :title="$t('Delete')">{{ tag }}</div>
		</div>
	</div>
</template>

<style>
.input_tag_wrapper,
.input_tag_list {
	box-sizing: border-box;
	float: left;
	width: 100%;
	border-radius: var(--border-radius);
}
.input_tag_list {
	padding: 5px;
}

.input_tag_list {
	float: left;
	width: 100%;
	height: auto;
	overflow: hidden;
}
.input_tag_input {
	float: left;
	width: 100%;
	margin-right: 5px;
	margin-top: 5px;
	margin-bottom: 5px;
	padding: 15px 20px;
	line-height: 1.5;
	font-size: 16px;
	cursor: pointer;
	transition: all 0.6s;
	border-radius: var(--border-radius);
	border: 1px solid var(--input-border);
}
.input_tag_input:focus {
	background: var(--bg-2);
	border: 1px solid var(--accent);
	box-shadow: 0px 0px 0px 5px var(--input-shadow);
}

.input_tag_item {
	float: left;
	width: auto;
	margin-right: 5px;
	margin-top: 5px;
	margin-bottom: 5px;
	color: #148936;
	background: #e6f4ea;
	color: #0075ff;
	background: #ddf4ff;
	padding: 5px 10px;
	border-radius: var(--border-radius);
	font-size: 13px;
	cursor: pointer;
}
.input_tag_item:hover {
	color: #fff;
	background: #f25;
}
</style>
