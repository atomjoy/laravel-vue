<template>
	<div class="panel_layout_title">{{ $t(props.title) }}</div>
</template>

<script setup>
const props = defineProps({
	title: { default: '' },
});
</script>
