<script setup>
import { onBeforeMount } from 'vue';
import { useAuthStore } from '@/stores/auth.js';
import SettingsLayout from '@/components/panel/client/settings/SettingsLayout.vue';
import SettingsGroup from '@/components/panel/client/settings/SettingsGroup.vue';
import Label from '@/components/auth/Label.vue';
import Button from '@/components/auth/Button.vue';
import Password from '@/components/auth/Password.vue';

const auth = useAuthStore();

onBeforeMount(() => {
	auth.clearError();
});

function onSubmit(e) {
	auth.clearError();
	auth.scrollTop();
	auth.deleteUserAccount(new FormData(e.target));
}
</script>

<template>
	<SettingsLayout>
		<SettingsGroup title="Delete Account" desc="You can delete your account here.">
			<form action="post" @submit.prevent="onSubmit">
				<Label text="Current password" />
				<Password name="current_password" />
				<Button text="Delete Account Now!" class="settings_button settings_button_red" />
			</form>
		</SettingsGroup>
	</SettingsLayout>
</template>
