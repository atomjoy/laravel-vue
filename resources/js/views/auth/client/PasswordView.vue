<script setup>
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';
import { useAuthStore } from '@/stores/auth.js';
import ChangeTitle from '@/components/utils/head/ChangeTitle.vue';
import AuthLayout from '@/layouts/auth/client/AuthLayout.vue';
import ErrorMessage from '@/components/auth/ErrorMessage.vue';
import LoginForm from '@/components/auth/LoginForm.vue';
import Email from '@/components/auth/Email.vue';
import Label from '@/components/auth/Label.vue';
import Title from '@/components/auth/Title.vue';
import Button from '@/components/auth/Button.vue';
import SignInLink from '@/components/auth/SignInLink.vue';

const { t, locale } = useI18n({ useScope: 'global' });
const store = useAuthStore();
let email = ref('');

function onSubmit(e) {
	store.clearError();
	store.scrollTop();
	store.resetUserPassword(new FormData(e.target));
}
</script>
<template>
	<AuthLayout>
		<ChangeTitle title="message.password_title" />
		<LoginForm @submit.prevent="onSubmit">
			<Title title="password.Reset_password" text="password.Welcome_text" />
			<ErrorMessage :message="store.getMessage" :error="store.getError" />
			<Label text="password.Email_address" />
			<Email name="email" v-model="email" />
			<Button text="password.Send_password" />
			<SignInLink />
		</LoginForm>
	</AuthLayout>
</template>
