<script setup>
import PanelLayout from '@/layouts/panel/client/PanelLayout.vue';
import { useAuthStore } from '@/stores/auth.js';
import { ref } from 'vue';
const auth = useAuthStore();
// let user = auth.getUser;
</script>

<template>
	<PanelLayout title="Vip">
		<div class="panel_wrapper">
			<h1>Vip List</h1>
			<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Necessitatibus laborum amet veritatis, voluptatibus itaque, expedita ratione dicta modi culpa id laudantium quidem, voluptas illum. In, maxime? Nobis id temporibus ea!</p>
		</div>
	</PanelLayout>
</template>

<style>
.panel_wrapper {
	padding-inline: 30px;
}
</style>
