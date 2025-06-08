<script setup>
import Header from '@/layouts/auth/parts/HeaderLayout.vue';
</script>

<template>
	<div class="split_layout">
		<div class="split_layout_left">
			<Header />
			<slot></slot>
		</div>

		<div class="split_layout_right">
			<slot name="image">
				<img src="/default/login/user.webp" class="split_layout_image" :alt="$t('Login image')" />
			</slot>
		</div>
	</div>
</template>
