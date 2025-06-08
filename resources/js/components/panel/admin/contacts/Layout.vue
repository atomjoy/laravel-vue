<script setup>
import PanelLayout from '@/layouts/panel/admin/PanelLayout.vue';
import ErrorMessage from '@/components/auth/ErrorMessage.vue';
import Menu from './Menu.vue';

const props = defineProps({
	message: { default: null },
	error: { default: true },
	edit: { default: false },
});
</script>

<template>
	<PanelLayout title="Contacts">
		<div class="panel_settings">
			<div class="panel_settings_menu">
				<Menu :edit="props.edit" />
			</div>

			<div class="panel_settings_error">
				<ErrorMessage :message="props.message" :error="props.error" />
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
