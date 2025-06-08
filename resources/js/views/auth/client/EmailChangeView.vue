<script setup>
import { useRoute } from 'vue-router';
import { onMounted } from 'vue';
import { useI18n } from 'vue-i18n';
import { useAuthStore } from '@/stores/auth.js';
import ChangeTitle from '@/components/utils/head/ChangeTitle.vue';
import AuthLayout from '@/layouts/auth/client/AuthLayout.vue';
import ErrorMessage from '@/components/auth/ErrorMessage.vue';
import LoginForm from '@/components/auth/LoginForm.vue';
import Title from '@/components/auth/Title.vue';
import SignInLink from '@/components/auth/SignInLink.vue';
import TipMsg from '@/components/auth/TipMsg.vue';

const { t, locale } = useI18n({ useScope: 'global' });
const store = useAuthStore();
const route = useRoute();

onMounted(() => {
	store.clearError();
	if (route.query.locale) {
		locale.value = route.query.locale;
		store.changeLocale(route.query.locale);
	}
	store.confirmUserEmail(route.params.id, route.params.code);
});
</script>

<template>
	<AuthLayout>
		<ChangeTitle title="message.change_email_title" />
		<LoginForm>
			<Title title="change_email.Confirm" text="change_email.Welcome_text" />
			<ErrorMessage :message="store.getMessage" :error="store.getError" />
			<TipMsg text="change_email.Description" />
			<SignInLink />
		</LoginForm>
	</AuthLayout>
</template>
