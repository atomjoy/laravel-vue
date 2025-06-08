<script setup>
const props = defineProps({
	text: [String],
});
</script>
<template>
	<div class="activation_wrapper">
		<p class="activation_wrapper_tip">
			{{ $t(props.text) }}
		</p>
	</div>
</template>
