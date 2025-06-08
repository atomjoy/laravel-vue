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
	auth.changeUserEmailAdmin(new FormData(e.target));
}

function onSubmitF2a(e) {
	auth.scrollTop();

	if (user.value.f2a == 1) {
		auth.disableF2aAdmin(new FormData(e.target));
	} else {
		auth.enableF2aAdmin(new FormData(e.target));
	}
}
</script>

<template>
	<SettingsLayout>
		<SettingsGroup title="Change account email" desc="Update your account email here.">
			<form action="post" @submit.prevent="onSubmitEmail">
				<Label text="Email address" />
				<Email v-model="user.email" />
				<Button text="Update" class="settings_button" />
			</form>
		</SettingsGroup>

		<SettingsGroup title="Two factor authentication" desc="Update your two-factor authentication details here.">
			<form action="post" @submit.prevent="onSubmitF2a">
				<div v-if="user.f2a == 1" class="panel_settings_group_f2a_enabled">
					{{ $t('Enabled') }}
				</div>
				<div v-if="user.f2a == 0" class="panel_settings_group_f2a_disabled">
					{{ $t('Disabled') }}
				</div>
				<Label text="Current password" />
				<Password name="password_current" />
				<Button text="Update" class="settings_button" />
			</form>
		</SettingsGroup>
	</SettingsLayout>
</template>
