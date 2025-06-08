<script setup>
import { onBeforeMount, ref, computed } from 'vue';
import SettingsGroupSubTitle from '@/components/panel/admin/settings/SettingsGroupSubTitle.vue';
import SettingsLayout from '@/components/panel/admin/settings/SettingsLayout.vue';
import SettingsGroup from '@/components/panel/admin/settings/SettingsGroup.vue';
import { useAuthStore } from '@/stores/auth.js';
import AvatarInput from '@/components/auth/AvatarInputAdmin.vue';
import Textarea from '@/components/auth/Textarea.vue';
import Label from '@/components/auth/Label.vue';
import Input from '@/components/auth/Input.vue';
import YesNo from '@/components/auth/YesNo.vue';
import Button from '@/components/auth/Button.vue';
import IconUser from '@/assets/icons/IconUser.vue';
import IconHome from '@/assets/icons/IconHome.vue';
import IconPhone from '@/assets/icons/IconPhone.vue';
import IconPrefix from '@/assets/icons/IconPrefix.vue';
import IconEdit from '@/assets/icons/IconEdit.vue';

const auth = useAuthStore();
let user = auth.getUser;

let avatar = ref('');
let allow_email = ref(0);
let allow_sms = ref(0);

onBeforeMount(() => {
	auth.clearError();
	allow_email.value = user.value?.allow_email ?? 0;
	allow_sms.value = user.value?.allow_sms ?? 0;
});

let userAvatar = computed({
	get() {
		return user.value?.avatar ?? '';
	},
	set(val) {
		avatar.value = val;
	},
});

function onSubmitAvatar(e) {
	auth.clearError();
	auth.scrollTop();
	auth.changeUserAvatarAdmin(new FormData(e.target));
}

function onSubmit(e) {
	auth.clearError();
	auth.scrollTop();
	let data = new FormData(e.target);
	auth.changeUserDetailsAdmin(data);
}
</script>

<template>
	<SettingsLayout>
		<SettingsGroup title="Upload avatar" desc="Upload your avatar image here.">
			<form action="post" @submit.prevent="onSubmitAvatar" enctype="multipart/form-data">
				<AvatarInput label="Select image" :avatar="userAvatar" />

				<Button text="Update" class="settings_button" />
			</form>
		</SettingsGroup>

		<SettingsGroup title="Detail settings" desc="Update your account details here.">
			<form action="post" @submit.prevent="onSubmit">
				<Label text="Name" />
				<Input name="name" v-model="user.name">
					<IconUser />
				</Input>

				<Label text="Location" />
				<Input name="location" v-model="user.location">
					<IconHome />
				</Input>

				<Label text="Bio" />
				<Textarea name="bio" v-model="user.bio" />

				<SettingsGroupSubTitle title="Contact phone" />

				<Label text="Country prefix" />
				<Input name="mobile_prefix" v-model="user.mobile_prefix">
					<IconPrefix />
				</Input>

				<Label text="Mobile number" />
				<Input name="mobile" v-model="user.mobile">
					<IconPhone />
				</Input>

				<SettingsGroupSubTitle title="Newsletter" />

				<Label text="Email newsletter" />
				<YesNo name="allow_email" v-model="allow_email" />

				<Label text="Sms newsletter" />
				<YesNo name="allow_sms" v-model="allow_sms" />

				<SettingsGroupSubTitle title="Address" />

				<Label text="Country" />
				<Input name="address_country" v-model="user.address_country">
					<IconEdit />
				</Input>

				<Label text="State" />
				<Input name="address_state" v-model="user.address_state">
					<IconEdit />
				</Input>

				<Label text="City" />
				<Input name="address_city" v-model="user.address_city">
					<IconEdit />
				</Input>

				<Label text="Postal code" />
				<Input name="address_postal" v-model="user.address_postal">
					<IconEdit />
				</Input>

				<Label text="Address line 1" />
				<Input name="address_line1" v-model="user.address_line1">
					<IconEdit />
				</Input>

				<Label text="Address line 2" />
				<Input name="address_line2" v-model="user.address_line2">
					<IconEdit />
				</Input>

				<Button text="Update" class="settings_button" />
			</form>
		</SettingsGroup>
	</SettingsLayout>
</template>
