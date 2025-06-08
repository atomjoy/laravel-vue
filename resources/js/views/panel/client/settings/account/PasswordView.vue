<script setup>
import { onBeforeMount, ref } from 'vue';
import { useAuthStore } from '@/stores/auth.js';
import SettingsLayout from '@/components/panel/client/settings/SettingsLayout.vue';
import SettingsGroup from '@/components/panel/client/settings/SettingsGroup.vue';
import Label from '@/components/auth/Label.vue';
import Button from '@/components/auth/Button.vue';
import Password from '@/components/auth/Password.vue';

const auth = useAuthStore();
let password = ref('');
let password_current = ref('');
let password_confirmation = ref('');

onBeforeMount(() => {
	auth.clearError();
});

function onSubmit(e) {
	auth.clearError();
	auth.scrollTop();
	auth.changeUserPassword(new FormData(e.target));
}
</script>

<template>
	<SettingsLayout>
		<SettingsGroup title="Password settings" desc="Update your password here.">
			<form action="post" @submit.prevent="onSubmit">
				<Label text="Current password" />
				<Password name="password_current" v-model="password_current" />
				<Label text="New password" />
				<Password name="password" v-model="password" />
				<Label text="Confirm password" />
				<Password name="password_confirmation" v-model="password_confirmation" />
				<Button text="Update" class="settings_button" />
			</form>
		</SettingsGroup>
	</SettingsLayout>
</template>
