<script setup>
let props = defineProps({
	title: { type: String, default: '', required: true },
	text: { type: String, default: '' },
});
</script>

<template>
	<div class="welcome_wrapper">
		<h2 class="welcome_wrapper_title">
			{{ $t(props.title) }}
		</h2>
		<p v-if="props.text" class="welcome_wrapper_description">
			{{ $t(props.text) }}
		</p>
	</div>
</template>
