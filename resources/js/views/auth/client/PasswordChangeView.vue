<script setup>
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';
import { useAuthStore } from '@/stores/auth.js';
import ChangeTitle from '@/components/utils/head/ChangeTitle.vue';
import AuthLayout from '@/layouts/auth/client/AuthLayout.vue';
import ErrorMessage from '@/components/auth/ErrorMessage.vue';
import LoginForm from '@/components/auth/LoginForm.vue';
import Label from '@/components/auth/Label.vue';
import Title from '@/components/auth/Title.vue';
import Button from '@/components/auth/Button.vue';
import Password from '@/components/auth/PasswordValid.vue';

const { t, locale } = useI18n({ useScope: 'global' });
const store = useAuthStore();
let password = ref('');
let password_current = ref('');
let password_confirmation = ref('');

function onSubmit(e) {
	store.clearError();
	store.scrollTop();
	store.changeUserPassword(new FormData(e.target));
}
</script>
<template>
	<AuthLayout>
		<ChangeTitle title="message.change_password_title" />
		<LoginForm @submit.prevent="onSubmit" id="reset-form-store">
			<Title title="change_password.Change_password" text="change_password.Welcome_text" />
			<ErrorMessage :message="store.getMessage" :error="store.getError" />
			<Label text="change_password.Current_password" />
			<Password type="password" name="password_current" v-model="password_current" />
			<Label text="change_password.New_password" />
			<Password type="password" name="password" v-model="password" />
			<Label text="change_password.Confirm_password" />
			<Password type="password" name="password_confirmation" v-model="password_confirmation" />
			<Button text="change_password.Change" />
		</LoginForm>
	</AuthLayout>
</template>
