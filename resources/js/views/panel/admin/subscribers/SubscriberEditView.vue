<script setup>
import Group from '@/components/panel/admin/subscribers/Group.vue';
import Layout from '@/components/panel/admin/subscribers/Layout.vue';
import Label from '@/components/auth/Label.vue';
import Input from '@/components/auth/Input.vue';
import Select from '@/components/auth/Select.vue';
import Button from '@/components/auth/Button.vue';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import { useItemStore } from '@/stores/admin/subscribers.js';

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
		<Group title="Subscribers" desc="Here you can update subscriber.">
			<form action="post" @submit.prevent="onSubmit">
				<Label text="Email" />
				<Input name="email" v-model="store.item.email" />
				<Label text="Name" />
				<Input name="name" v-model="store.item.name" />
				<Label text="Confirmed" />
				<Select
					name="is_approved"
					v-model="store.item.is_approved"
					:options="[
						{ id: 1, name: $t('Yes') },
						{ id: 0, name: $t('No') },
					]"
				/>
				<Button text="Update" class="settings_button" />
			</form>
		</Group>
	</Layout>
</template>
