<script setup>
import { onBeforeMount, ref } from 'vue';
import { useAuthStore } from '@/stores/auth.js';
import SettingsLayout from '@/components/panel/admin/settings/SettingsLayout.vue';
import SettingsGroup from '@/components/panel/admin/settings/SettingsGroup.vue';
import Label from '@/components/auth/Label.vue';
import Email from '@/components/auth/Email.vue';
import Button from '@/components/auth/Button.vue';
import Password from '@/components/auth/Password.vue';

const auth = useAuthStore();
let user = auth.getUser;

onBeforeMount(() => {
	auth.clearError();
});

function onSubmitEmail(e) {
	auth.clearError();
	auth.scrollTop();
	// auth.changeUserEmailNotificationAdmin(new FormData(e.target));
}
</script>

<template>
	<SettingsLayout>
		<SettingsGroup title="Email notifications" desc="Update your email notifications here.">
			<form action="post" @submit.prevent="onSubmitEmail">
				<Label text="Email address" />
				<Email v-model="user.email" />
				<Button text="Update" class="settings_button" />
			</form>
		</SettingsGroup>
	</SettingsLayout>
</template>
