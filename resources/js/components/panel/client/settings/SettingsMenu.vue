<script setup>
import { RouterLink } from 'vue-router';
</script>

<template>
	<RouterLink to="/panel/settings/account" class="panel_settings_link">
		{{ $t('Account') }}
	</RouterLink>

	<RouterLink to="/panel/settings/details" class="panel_settings_link">
		{{ $t('Details') }}
	</RouterLink>

	<RouterLink to="/panel/settings/password" class="panel_settings_link">
		{{ $t('Password') }}
	</RouterLink>

	<RouterLink to="/panel/settings/delete" class="panel_settings_link">
		{{ $t('Delete Account') }}
	</RouterLink>
</template>
