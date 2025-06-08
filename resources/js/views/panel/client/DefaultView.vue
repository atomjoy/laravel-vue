<script setup>
import { RouterLink } from 'vue-router';
import PanelLayout from '@/layouts/panel/client/PanelLayout.vue';
</script>

<template>
	<PanelLayout title="Dashboard">
		<!-- Page content goes here -->
		Admin content goes here.
		<RouterLink to="/panel/dashboard"> {{ $t('Client Panel') }}</RouterLink>
		<!-- Page content goes here -->
	</PanelLayout>
</template>

<style>
@import url('@/assets/css/main.css');
</style>
