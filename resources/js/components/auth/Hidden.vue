<template>
	<input :name="props.name" v-model="model" type="hidden" />
</template>

<script setup>
const model = defineModel();
const props = defineProps({
	name: { type: String, default: 'hash' },
});
</script>
