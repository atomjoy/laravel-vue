<script setup>
import { RouterLink } from 'vue-router';
const props = defineProps({
	edit: { default: false },
});
</script>

<template>
	<RouterLink to="/admin/users" class="panel_settings_link">
		{{ $t('List') }}
	</RouterLink>

	<!-- <RouterLink to="/admin/users/create" class="panel_settings_link">
		{{ $t('Create') }}
	</RouterLink> -->

	<RouterLink to="/admin/users/edit" class="panel_settings_link" :class="{ 'router-link-active': props.edit }">
		{{ $t('Edit') }}
	</RouterLink>
</template>
