<script setup>
let props = defineProps({
	color: { type: String, default: '#0099ff' },
	text: { type: String, default: 'Colored Text' },
	size: { type: String, default: '25px' },
});
</script>

<template>
	<span class="colored_text">{{ text }}</span>
</template>

<style scoped>
.attribute {
	--color: v-bind(props.color);
}

.colored_text {
	margin-right: 20px;
	color: v-bind('props.color');
	font-size: v-bind('props.size');
}
</style>
