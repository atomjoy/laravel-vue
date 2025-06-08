<script setup>
import ChangeTheme from '@/components/utils/head/ChangeTheme.vue';
import ChangeLocale from '@/components/utils/head/ChangeLocale.vue';
import PageLogo from '@/components/auth/PageLogo.vue';
</script>

<template>
	<PageLogo />
	<ChangeTheme />
	<ChangeLocale />
	<slot></slot>
</template>
