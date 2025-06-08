<script setup>
// Change login layout here ...
// import Auth from '@/layouts/auth/parts/SplitLayout.vue';
import AuthLayout from '@/layouts/auth/parts/SimpleLayout.vue';
</script>
<template>
	<AuthLayout>
		<slot></slot>
		<template #image>
			<img src="/default/login/admin.webp" class="login-image" :alt="$t('Login image')" />
		</template>
	</AuthLayout>
</template>

<style>
@import url('@/assets/css/auth/main.css');
</style>
