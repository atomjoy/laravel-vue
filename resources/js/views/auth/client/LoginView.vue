<script setup>
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';
import { useAuthStore } from '@/stores/auth.js';
import ChangeTitle from '@/components/utils/head/ChangeTitle.vue';
import AuthLayout from '@/layouts/auth/client/AuthLayout.vue';
import ErrorMessage from '@/components/auth/ErrorMessage.vue';
import LoginForm from '@/components/auth/LoginForm.vue';
import Label from '@/components/auth/Label.vue';
import Email from '@/components/auth/Email.vue';
import Title from '@/components/auth/Title.vue';
import Button from '@/components/auth/Button.vue';
import Password from '@/components/auth/Password.vue';
import RememberMe from '@/components/auth/RememberMe.vue';
import SignUpLink from '@/components/auth/SignUpLink.vue';
import SocialLogin from '@/components/auth/SocialLogin.vue';

const { t, locale } = useI18n({ useScope: 'global' });
const store = useAuthStore();
let email = ref('');
let password = ref('');
let remember_me = ref(false);

function onSubmit(e) {
	store.clearError();
	store.scrollTop();
	store.loginUser(new FormData(e.target));
}
</script>
<template>
	<AuthLayout>
		<ChangeTitle title="message.login_title" />
		<LoginForm @submit.prevent="onSubmit">
			<Title title="login.Sign_In" text="login.Welcome_text" />
			<ErrorMessage :message="store.getMessage" :error="store.getError" />
			<Label text="login.Email_address" />
			<Email name="email" v-model="email" />
			<Label text="login.Password" />
			<Password name="password" v-model="password" type="password" />
			<RememberMe value="1" name="remember_me" label="login.Remember_me" link="login.Forgot_password" v-model="remember_me" />
			<Button text="login.Login" />
			<SignUpLink />
			<SocialLogin />
		</LoginForm>
	</AuthLayout>
</template>
