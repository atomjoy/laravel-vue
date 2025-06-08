<script setup>
import { RouterLink } from 'vue-router';
import IconSettings from '@/assets/icons/IconSettings.vue';
import IconLogout from '@/assets/icons/IconLogout.vue';
import UserInfoLayout from './UserInfoLayout.vue';
</script>

<template>
	<UserInfoLayout>
		<!-- User navbar links goes here -->

		<RouterLink to="/admin/settings" class="user_info_layout_link">
			<IconSettings />
			<span>{{ $t('Settings') }}</span>
		</RouterLink>

		<RouterLink to="/admin/logout" class="user_info_layout_link">
			<IconLogout />
			<span>{{ $t('Logout') }}</span>
		</RouterLink>
	</UserInfoLayout>
</template>
