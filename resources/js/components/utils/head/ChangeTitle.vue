<template></template>
<script setup>
import { useI18n } from 'vue-i18n';
import { watch, onMounted } from 'vue';

const { t, locale } = useI18n({ useScope: 'global' });

const props = defineProps({
	title: {
		type: String,
		default: '',
	},
});

onMounted(() => {
	document.title = t(props.title);
});

watch(
	() => locale.value,
	(lang) => {
		if (props.title) {
			document.title = t(props.title);
		}
	}
);

watch(
	() => props.title,
	(lang) => {
		if (props.title) {
			document.title = t(props.title);
		}
	}
);
</script>

<!--
// Require in main.js createI18n(options)
allowComposition: true,
globalInjection: true,
legacy: false,
-->
