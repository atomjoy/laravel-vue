<template>
	<label class="label_wrapper">{{ $t(props.text) }}</label>
</template>

<script setup>
const props = defineProps({
	text: { type: String, default: 'Name' },
});
</script>
