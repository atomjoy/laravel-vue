<script setup>
import Group from '@/components/panel/admin/subscribers/Group.vue';
import Layout from '@/components/panel/admin/subscribers/Layout.vue';
import Label from '@/components/auth/Label.vue';
import Input from '@/components/auth/Input.vue';
import Select from '@/components/auth/Select.vue';
import Button from '@/components/auth/Button.vue';
import { onMounted, ref } from 'vue';
import { useItemStore } from '@/stores/admin/subscribers.js';

const store = useItemStore();
let approved = ref(1);

onMounted(async () => {
	store.clearError();
	store.item = null;
});
</script>

<template>
	<Layout :message="store.getMessage" :error="store.getError">
		<Group title="Subscribers" desc="Here you can create subscriber.">
			<form action="post" @submit.prevent="store.createItem">
				<Label text="Email" />
				<Input name="email" />
				<Label text="Name" />
				<Input name="name" />
				<Label text="Confirmed" />
				<Select
					name="is_approved"
					v-model="approved"
					:options="[
						{ id: 1, name: $t('Yes') },
						{ id: 0, name: $t('No') },
					]"
				/>
				<Button text="Create" class="settings_button" />
			</form>
		</Group>
	</Layout>
</template>
