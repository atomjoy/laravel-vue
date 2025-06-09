<script setup>
let props = defineProps({
	message: { type: String, default: null },
	error: { type: [String, Boolean], default: false },
});
</script>

<template>
	<div class="alert_wrapper" v-if="props.message != null">
		<div class="animate__animated animate__flipInX" :class="[props.error ? 'alert_wrapper_error' : 'alert_wrapper_info']">
			{{ $t(props.message) }}
		</div>
	</div>
</template>
