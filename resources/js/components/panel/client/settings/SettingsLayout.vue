<script setup>
import { useAuthStore } from '@/stores/auth.js';
import PanelLayout from '@/layouts/panel/client/PanelLayout.vue';
import ErrorMessage from '@/components/auth/ErrorMessage.vue';
import SettingsMenu from '@/components/panel/client/settings/SettingsMenu.vue';

const auth = useAuthStore();
</script>

<template>
	<PanelLayout title="Settings">
		<div class="panel_settings">
			<div class="panel_settings_menu">
				<SettingsMenu />
			</div>

			<div class="panel_settings_error">
				<ErrorMessage :message="auth.getMessage" :error="auth.getError" />
			</div>

			<div class="panel_settings_main">
				<slot />
			</div>
		</div>
	</PanelLayout>
</template>

<style>
@import url('@/assets/css/auth/form.css');
@import url('@/assets/css/panel/panel.css');
@import url('@/assets/css/panel/settings.css');
</style>
