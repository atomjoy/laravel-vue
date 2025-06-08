<script setup>
import { RouterLink } from 'vue-router';
import PanelLayout from '@/layouts/panel/admin/PanelLayout.vue';
</script>

<template>
	<PanelLayout title="Dashboard">
		<!-- Page content goes here -->
		Client content goes here.
		<RouterLink to="/admin.panel"> {{ $t('Admin Panel') }}</RouterLink>
		<!-- Page content goes here -->
	</PanelLayout>
</template>

<style>
@import url('@/assets/css/main.css');
</style>
