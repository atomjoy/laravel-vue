<script setup>
import Label from '@/components/auth/Label.vue';
import Input from '@/components/auth/Input.vue';
import Button from '@/components/auth/Button.vue';
import Group from '@/components/panel/admin/users/GroupList.vue';
import Layout from '@/components/panel/admin/users/Layout.vue';
import { onMounted } from 'vue';
import { useItemStore } from '@/stores/admin/users.js';

const store = useItemStore();

onMounted(async () => {
	store.clearError();
	store.item = 'null';
	store.item_image = null;
});
</script>

<template>
	<Layout :message="store.getMessage" :error="store.getError">
		<Group title="Users" desc="Here you can create user.">
			<form action="post" @submit.prevent="store.createItem" enctype="multipart/form-data">
				<Label text="Name" />
				<Input name="name" />
				<Label text="Email" />
				<Input name="email" />
				<Label text="Image" />
				<Input type="file" name="file" @change="store.getImagePath" />
				<div class="panel_item_image" v-if="store.item_image">
					<img id="img" :src="store.item_image" onerror="this.remove()" />
				</div>
				<Button text="Send" class="settings_button" />
			</form>
		</Group>
	</Layout>
</template>
