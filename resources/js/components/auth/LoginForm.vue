<script setup>
const emits = defineEmits(['submit']);
</script>

<template>
	<div class="login_form_wrapper">
		<form id="reset-form-store" class="login_form" @submit.prevent="emits('submit', $event)">
			<slot></slot>
		</form>
	</div>
</template>
