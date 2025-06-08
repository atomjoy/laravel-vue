<template></template>
<script setup>
import { watch, onMounted } from 'vue';
import { useI18n } from 'vue-i18n';

const { t, locale } = useI18n({ useScope: 'global' });

const props = defineProps({
	description: {
		type: String,
		default: '',
	},
});

const el = document.querySelector('head meta[name="description"]');

onMounted(() => {
	el.setAttribute('content', t(props.description));
});

watch(
	() => locale.value,
	(lang) => {
		if (props.description) {
			el.setAttribute('content', t(props.description));
		}
	}
);

watch(
	() => props.description,
	(lang) => {
		if (props.description) {
			el.setAttribute('content', t(props.description));
		}
	}
);
</script>

<!--
// Required in main.js createI18n(options)
allowComposition: true,
globalInjection: true,
legacy: false,
-->
