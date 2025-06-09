<template>
	<label class="label_subtitle">{{ $t(props.text) }}</label>
</template>

<script setup>
const props = defineProps({
	text: { type: String, default: 'Read only details' },
});
</script>
