<script>
import { RouterLink } from 'vue-router';
</script>

<template>
	<RouterLink to="/homepage" class="logo_wrapper">
		<img src="/default/logo/logo-light.png" class="logo_wrapper_image" alt="Logo" />
	</RouterLink>
</template>

<style>
.logo_wrapper {
	float: left;
	height: auto;
	width: auto;
}

.logo_wrapper_image {
	float: left;
	max-height: 50px;
	content: var(--logo);
}
</style>
