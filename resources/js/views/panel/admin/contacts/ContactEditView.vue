<script setup>
import Layout from '@/components/panel/admin/contacts/Layout.vue';
import Group from '@/components/panel/admin/contacts/Group.vue';
import Label from '@/components/auth/Label.vue';
import Input from '@/components/auth/Input.vue';
import Button from '@/components/auth/Button.vue';
import Textarea from '@/components/auth/Textarea.vue';
import FileDownload from '@/components/auth/FileDownload.vue';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import { useItemStore } from '@/stores/admin/contacts.js';

const store = useItemStore();
const route = useRoute();
const id = route.params.id;

onMounted(async () => {
	store.clearError();
	await store.loadItem(id);
});

function onSubmit(e) {
	store.updateItem(id, new FormData(e.target));
}
</script>

<template>
	<Layout :message="store.getMessage" :error="store.getError" :edit="true">
		<Group title="Contact" desc="Here you can update contact note.">
			<form action="post" @submit.prevent="onSubmit">
				<Label text="First Name" />
				<Input name="firstname" v-model="store.item.firstname" />
				<Label text="Last Name" />
				<Input name="lastname" v-model="store.item.lastname" />
				<Label text="Email" />
				<Input name="email" v-model="store.item.email" />
				<Label text="Mobile" />
				<Input name="mobile" v-model="store.item.mobile" />
				<Label text="Ip address" />
				<Input name="ip" v-model="store.item.ip" />
				<Label text="Message" />
				<Textarea name="message" v-model="store.item.message" />
				<Label text="File" />
				<FileDownload v-model="store.item.file" />
				<Label text="Note" />
				<Textarea name="note" v-model="store.item.note" />

				<Button text="Update" class="settings_button" />
			</form>
		</Group>
	</Layout>
</template>
