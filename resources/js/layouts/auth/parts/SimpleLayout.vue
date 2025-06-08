<script setup>
import Header from '@/layouts/auth/parts/HeaderLayout.vue';
</script>

<template>
	<div class="simple_layout">
		<div class="simple_layout_content">
			<Header />
			<slot></slot>
		</div>

		<div class="simple_layout_footer">
			<slot name="footer"></slot>
		</div>
	</div>
</template>
