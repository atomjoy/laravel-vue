<script setup>
let props = defineProps({
	text: { type: String, default: 'Update', required: true },
	disabled: { type: Boolean, default: false },
	class: { type: String, default: '' },
});
</script>

<template>
	<div class="button_wrapper">
		<input
			type="submit"
			class="button_wrapper_field"
			:class="props.class"
			:value="$t(props.text)"
			:disabled="props.disabled"
		/>
	</div>
</template>
