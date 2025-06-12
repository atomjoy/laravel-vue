<script setup>
import Layout from '@/components/panel/admin/contacts/Layout.vue';
import Group from '@/components/panel/admin/contacts/Group.vue';
import Label from '@/components/auth/Label.vue';
import Input from '@/components/auth/Input.vue';
import Button from '@/components/auth/Button.vue';
import Textarea from '@/components/auth/Textarea.vue';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import { useItemStore } from '@/stores/client/comments.js';

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
		<Group title="Comments" desc="Here you can update comment.">
			<form action="post" @submit.prevent="onSubmit">
				<Label text="Message" />
				<Textarea name="message" v-model="store.item.message" />

				<Button text="Update" class="settings_button" />
			</form>
		</Group>
	</Layout>
</template>
