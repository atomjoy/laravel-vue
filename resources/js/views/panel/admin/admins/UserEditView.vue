<script setup>
import Label from '@/components/auth/Label.vue';
import Input from '@/components/auth/Input.vue';
import SelectText from '@/components/auth/SelectText.vue';
import Hidden from '@/components/auth/Hidden.vue';
import Textarea from '@/components/auth/Textarea.vue';
import Button from '@/components/auth/Button.vue';
import YesNo from '@/components/auth/YesNo.vue';
import ErrorMessage from '@/components/auth/ErrorMessage.vue';
import Subtitle from '@/components/auth/Subtitle.vue';
import Group from '@/components/panel/admin/admins/Group.vue';
import Layout from '@/components/panel/admin/admins/Layout.vue';
import NoRecords from '@/components/utils/alerts/NoRecords.vue';
import admin_roles from '@/settings/panel/admin_roles.json';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import { useItemStore } from '@/stores/admin/admins.js';

const store = useItemStore();
const route = useRoute();
const id = route.params.id;
const add_role = ref(null);
const remove_role = ref(null);
const add_permission = ref(null);
const remove_permission = ref(null);
const allowed_roles = admin_roles.roles;
const allowed_permissions = admin_roles.permissions;

onMounted(async () => {
	store.clearError();
	await store.loadItem(id);
	// console.log('Update', id, store.item);
});

function onSubmit(e) {
	store.updateItem(id, new FormData(e.target));
	store.scrollTop();
}

function onSubmitRole(e) {
	store.createRole(e);
	store.scrollTo('.error_role');
}

function onSubmitRemoveRole(e) {
	store.removeRole(e);
	store.scrollTo('.error_role');
}

function onSubmitPermission(e) {
	store.createPermission(e);
	store.scrollTo('.error_permission');
}

function onSubmitRemovePermission(e) {
	store.removePermission(e);
	store.scrollTo('.error_permission');
}
</script>

<template>
	<Layout :message="store.getMessage" :error="store.getError" :edit="true">
		<Group title="Admins" desc="Here you can edit admin details.">
			<form action="post" @submit.prevent="onSubmit" enctype="multipart/form-data">
				<Label text="Name" />
				<Input name="name" v-model="store.item.name" />
				<Label text="Enable 2FA" />
				<YesNo name="f2a" v-model="store.item.f2a" />
				<Label text="Image" />
				<Input type="file" name="file" id="panel_item_input" @change="store.getImagePath" />
				<div class="panel_item_image" v-if="store.item.avatar">
					<div class="panel_item_remove" @click="store.removeImage(store.item.id)">
						{{ $t('Delete') }}
					</div>
					<img id="img" :src="'/img/avatar?path=' + store.item.avatar" onerror="this.remove()" />
				</div>

				<Subtitle text="Read only details" />
				<Label text="Email" />
				<Input name="email" v-model="store.item.email" disabled="true" />
				<Label text="Location" />
				<Input name="location" v-model="store.item.location" disabled="true" />
				<Label text="Bio" />
				<Textarea name="bio" v-model="store.item.bio" disabled="true" />
				<Label text="Country prefix" />
				<Input name="mobile_prefix" v-model="store.item.mobile_prefix" disabled="true" />
				<Label text="Mobile number" />
				<Input name="mobile" v-model="store.item.mobile" disabled="true" />
				<Label text="Country" />
				<Input name="address_country" v-model="store.item.address_country" disabled="true" />
				<Label text="State" />
				<Input name="address_state" v-model="store.item.address_state" disabled="true" />
				<Label text="City" />
				<Input name="address_city" v-model="store.item.address_city" disabled="true" />
				<Label text="Postal code" />
				<Input name="address_postal" v-model="store.item.address_postal" disabled="true" />
				<Label text="Address line 1" />
				<Input name="address_line1" v-model="store.item.address_line1" disabled="true" />
				<Label text="Address line 2" />
				<Input name="address_line2" v-model="store.item.address_line2" disabled="true" />

				<Button text="Update" class="settings_button" />
			</form>
		</Group>

		<Group title="Roles" desc="Add or remove admin role.">
			<ErrorMessage class="error_role" :message="store.getMessage" :error="store.getError" />

			<Subtitle text="Add role" />
			<form action="post" @submit.prevent="onSubmitRole">
				<Label text="Role" />
				<SelectText name="role" v-model="add_role" :options="allowed_roles" />
				<Hidden name="userid" v-model="store.item.id" />

				<Button text="Update" class="settings_button" />
			</form>

			<Subtitle text="Remove role" />
			<form action="post" @submit.prevent="onSubmitRemoveRole">
				<Label text="Role" />
				<SelectText name="role" v-model="remove_role" :options="allowed_roles" />
				<Hidden name="userid" v-model="store.item.id" />

				<Button text="Update" class="settings_button" />
			</form>
		</Group>

		<Group title="Permissions" desc="Add or remove admin permissions.">
			<ErrorMessage class="error_permission" :message="store.getMessage" :error="store.getError" />

			<Subtitle text="Add permission" />
			<form action="post" @submit.prevent="onSubmitPermission">
				<Label text="Permission" />
				<SelectText name="role" v-model="add_permission" :options="allowed_permissions" />
				<Hidden name="userid" v-model="store.item.id" />

				<Button text="Update" class="settings_button" />
			</form>

			<Subtitle text="Remove permission" />
			<form action="post" @submit.prevent="onSubmitRemovePermission">
				<Label text="Permission" />
				<SelectText name="role" v-model="remove_permission" :options="allowed_permissions" />
				<Hidden name="userid" v-model="store.item.id" />

				<Button text="Update" class="settings_button" />
			</form>
		</Group>

		<Group title="Roles and permissions" desc="Here you can see your permissions.">
			<Subtitle text="Roles" />
			<div v-for="r in store.item.roles" class="panel_admin_role">
				<div class="panel_role_name">{{ r.name }}</div>
				<div class="panel_role_id" title="ID">{{ r.id }}</div>
				<div class="panel_role_guard" title="GUARD">{{ r.guard_name }}</div>
			</div>
			<NoRecords :show="store.item.roles.length == 0" />

			<Subtitle text="Permissions" />
			<div v-for="r in store.item.permission" class="panel_admin_permission">
				<div class="panel_permission_name">{{ r.name }}</div>
				<div class="panel_permission_id" title="ID">{{ r.id }}</div>
				<div class="panel_permission_guard" title="GUARD">{{ r.guard_name }}</div>
			</div>
			<NoRecords :show="store.item.permission.length == 0" />
		</Group>
	</Layout>
</template>
