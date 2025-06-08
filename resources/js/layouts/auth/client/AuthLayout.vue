<script setup>
// Change login layout here ...
// import AuthLayout from '@/layouts/auth/parts/SimpleLayout.vue';
import AuthLayout from '@/layouts/auth/parts/SplitLayout.vue';
</script>
<template>
	<AuthLayout>
		<slot></slot>
	</AuthLayout>
</template>

<style>
@import url('@/assets/css/auth/main.css');
</style>
