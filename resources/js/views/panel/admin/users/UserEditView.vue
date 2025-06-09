<script setup>
import Label from '@/components/auth/Label.vue';
import Input from '@/components/auth/Input.vue';
import Textarea from '@/components/auth/Textarea.vue';
import Button from '@/components/auth/Button.vue';
import YesNo from '@/components/auth/YesNo.vue';
import Subtitle from '@/components/auth/Subtitle.vue';
import Group from '@/components/panel/admin/users/GroupList.vue';
import Layout from '@/components/panel/admin/users/Layout.vue';
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { useItemStore } from '@/stores/admin/users.js';

const store = useItemStore();
const route = useRoute();
const id = route.params.id;

onMounted(async () => {
	store.clearError();
	await store.loadItem(id);
	console.log('Update', id, store.item);
});

function onSubmit(e) {
	store.updateItem(id, new FormData(e.target));
}
</script>

<template>
	<Layout :message="store.getMessage" :error="store.getError" :edit="true">
		<Group title="Users" desc="Here you can edit user details.">
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
					<img id="img" :src="'/img/show?path=' + store.item.avatar" onerror="this.remove()" />
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
	</Layout>
</template>
