<script setup>
let props = defineProps({
	message: { type: String, default: null },
	error: { type: String, default: false },
});
</script>

<template>
	<div class="alert_wrapper" v-if="props.message != null">
		<div class="animate__animated animate__flipInX" :class="[props.error ? 'alert_wrapper_error' : 'alert_wrapper_info']">
			{{ $t(props.message) }}
		</div>
	</div>
</template>

<style>
.alert_wrapper {
	float: left;
	width: 100%;
	margin-bottom: 20px;
}

.alert_wrapper_error {
	font-weight: 400;
	font-size: 14px;
	padding: 10px;
	color: var(--alert-error);
	background: var(--alert-error-bg);
	/* border: 1px solid var(--alert-error); */
}

.alert_wrapper_info {
	font-weight: 400;
	font-size: 14px;
	padding: 10px;
	color: var(--alert-info);
	background: var(--alert-info-bg);
	/* border: 1px solid var(--alert-info); */
}
</style>
