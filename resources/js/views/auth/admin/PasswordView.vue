<script setup>
import { ref, onMounted } from 'vue';
import { useI18n } from 'vue-i18n';
import { useAuthStore } from '@/stores/auth.js';
import AuthLayout from '@/layouts/auth/admin/AuthLayout.vue';
import ChangeTitle from '@/components/utils/head/ChangeTitle.vue';
import ErrorMessage from '@/components/auth/ErrorMessage.vue';
import LoginForm from '@/components/auth/LoginForm.vue';
import Title from '@/components/auth/Title.vue';
import Email from '@/components/auth/Email.vue';
import Label from '@/components/auth/Label.vue';
import Button from '@/components/auth/Button.vue';
import SignInLink from '@/components/auth/SignInLink.vue';

const { t, locale } = useI18n({ useScope: 'global' });
const store = useAuthStore();
let email = ref('');

onMounted(() => {
	store.clearError();
});

function onSubmit(e) {
	store.clearError();
	store.scrollTop();
	store.resetUserPasswordAdmin(new FormData(e.target));
}
</script>
<template>
	<AuthLayout>
		<ChangeTitle title="password.Reset_password_admin" />
		<LoginForm @submit.prevent="onSubmit">
			<Title title="password.Reset_password_admin" text="password.Welcome_text_admin" />
			<ErrorMessage :message="store.getMessage" :error="store.getError" />
			<Label text="password.Email_address" />
			<Email name="email" v-model="email" />
			<Button text="password.Send_password" class="button__admin" />
			<SignInLink url="/admin/login" />
		</LoginForm>
	</AuthLayout>
</template>
