<script setup>
import { RouterLink } from 'vue-router';
import ChangeTheme from '@/components/head/ChangeTheme.vue';
import ChangeLocale from '@/components/head/ChangeLocale.vue';
import PageLogo from '@/components/auth/PageLogo.vue';
</script>

<template>
	<nav>
		<PageLogo />
		<RouterLink to="/" class="menu_link">{{ $t('Home') }}</RouterLink>
		<RouterLink to="/about" class="menu_link">{{ $t('About') }}</RouterLink>
		<RouterLink to="/login" class="menu_link">{{ $t('Login') }}</RouterLink>
		<ChangeTheme />
		<ChangeLocale />
	</nav>
</template>
