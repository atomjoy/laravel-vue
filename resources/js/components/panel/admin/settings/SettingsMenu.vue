<script setup>
import { RouterLink } from 'vue-router';
</script>

<template>
	<RouterLink to="/admin/settings/account" class="panel_settings_link">
		{{ $t('Account') }}
	</RouterLink>

	<RouterLink to="/admin/settings/details" class="panel_settings_link">
		{{ $t('Details') }}
	</RouterLink>

	<RouterLink to="/admin/settings/password" class="panel_settings_link">
		{{ $t('Password') }}
	</RouterLink>

	<RouterLink to="/admin/settings/delete" class="panel_settings_link">
		{{ $t('Delete Account') }}
	</RouterLink>
</template>
