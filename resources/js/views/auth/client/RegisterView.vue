<script setup>
import { ref, onMounted } from 'vue';
import { useI18n } from 'vue-i18n';
import { useAuthStore } from '@/stores/auth.js';
import AuthLayout from '@/layouts/auth/client/AuthLayout.vue';
import ChangeTitle from '@/components/utils/head/ChangeTitle.vue';
import ErrorMessage from '@/components/auth/ErrorMessage.vue';
import LoginForm from '@/components/auth/LoginForm.vue';
import Label from '@/components/auth/Label.vue';
import Name from '@/components/auth/NameValid.vue';
import Email from '@/components/auth/EmailValid.vue';
import Title from '@/components/auth/Title.vue';
import Button from '@/components/auth/Button.vue';
import Password from '@/components/auth/PasswordValid.vue';
import SignInLink from '@/components/auth/SignInLink.vue';
import CheckboxPolicy from '@/components/auth/CheckboxPolicy.vue';

const { t, locale } = useI18n({ useScope: 'global' });
const store = useAuthStore();
let name = ref('');
let email = ref('');
let password = ref('');
let password_confirmation = ref('');
let confirm_services = ref(false);

function onSubmit(e) {
	store.clearError();
	store.scrollTop();
	if (confirm_services.value) {
		store.registerUser(new FormData(e.target));
	} else {
		alert(t('register.Confirm_services'));
	}
}
</script>
<template>
	<AuthLayout>
		<ChangeTitle title="message.register_title" />
		<LoginForm @submit.prevent="onSubmit" id="reset-form-store">
			<Title title="register.Sign_Up" text="register.Welcome_text" />
			<ErrorMessage :message="store.getMessage" :error="store.getError" />
			<Label text="register.Name" />
			<Name name="name" v-model="name" />
			<Label text="register.Email_address" />
			<Email name="email" v-model="email" />
			<Label text="register.Password" />
			<Password type="password" name="password" v-model="password" />
			<Label text="register.Confirm_password" />
			<Password type="password" name="password_confirmation" v-model="password_confirmation" />
			<CheckboxPolicy value="1" v-model="confirm_services" name="confirm_services" label="register.Confirm_services" link="register.Policy" link_url="/docs/policy" />
			<Button text="register.Register" :disabled="!confirm_services" />
			<SignInLink />
		</LoginForm>
	</AuthLayout>
</template>
