<script setup>
import { useRoute } from 'vue-router';
import { ref, onMounted } from 'vue';
import { useI18n } from 'vue-i18n';
import { useAuthStore } from '@/stores/auth.js';
import AuthLayout from '@/layouts/auth/admin/AuthLayout.vue';
import ChangeTitle from '@/components/utils/head/ChangeTitle.vue';
import ErrorMessage from '@/components/auth/ErrorMessage.vue';
import LoginForm from '@/components/auth/LoginForm.vue';
import Code from '@/components/auth/Code.vue';
import Title from '@/components/auth/Title.vue';
import Label from '@/components/auth/Label.vue';
import Button from '@/components/auth/Button.vue';
import Hidden from '@/components/auth/Hidden.vue';
import SignInLink from '@/components/auth/SignInLink.vue';
import RememberMe from '@/components/auth/RememberMe.vue';

const { t, locale } = useI18n({ useScope: 'global' });
const store = useAuthStore();
let code = ref('');
let remember_me = ref(false);

// Route
const route = useRoute();
let hash = ref(route?.params?.hash ?? null);
// console.log('Route', route?.query, route?.params)

onMounted(() => {
	store.clearError();
});

function onSubmit(e) {
	store.clearError();
	store.scrollTop();
	store.loginUserF2aAdmin(new FormData(e.target));
}
</script>
<template>
	<AuthLayout>
		<ChangeTitle title="login.F2a_Confirm_admin" />
		<LoginForm @submit.prevent="onSubmit">
			<Title title="login.F2a_Confirm_admin" text="login.Welcome_text_f2a_admin" />
			<ErrorMessage :message="store.getMessage" :error="store.getError" />
			<Label text="login.F2a_code" />
			<Code name="code" v-model="code" />
			<Hidden name="hash" v-model="hash" />
			<RememberMe name="remember_me" value="1" v-model="remember_me" label="login.Remember_me" link="login.Forgot_password" link_url="/admin/password" />
			<Button text="login.Confirm_btn" class="button__admin" />
			<SignInLink url="/admin/login" />
		</LoginForm>
	</AuthLayout>
</template>
