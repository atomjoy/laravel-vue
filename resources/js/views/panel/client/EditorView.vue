<script setup>
import PanelLayout from '@/layouts/panel/client/PanelLayout.vue';
import { useAuthStore } from '@/stores/auth.js';
import { ref } from 'vue';
const auth = useAuthStore();
// let user = auth.getUser;
</script>

<template>
	<PanelLayout title="Editor">
		<div class="panel_editor">
			<h1>Editor Panel</h1>
			<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Necessitatibus laborum amet veritatis, voluptatibus itaque, expedita ratione dicta modi culpa id laudantium quidem, voluptas illum. In, maxime? Nobis id temporibus ea!</p>
		</div>
	</PanelLayout>
</template>
