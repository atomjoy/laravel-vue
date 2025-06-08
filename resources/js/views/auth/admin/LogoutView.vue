<script setup>
import { useI18n } from 'vue-i18n';
import { useAuthStore } from '@/stores/auth.js';

const { t, locale, fallbackLocale } = useI18n({ useScope: 'global' });
const auth = useAuthStore();
locale.value = fallbackLocale.value;
auth.logoutUserAdmin();
</script>

<template></template>
