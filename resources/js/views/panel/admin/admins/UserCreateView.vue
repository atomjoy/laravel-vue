<script setup>
import Label from '@/components/auth/Label.vue';
import Input from '@/components/auth/Input.vue';
import YesNo from '@/components/auth/YesNo.vue';
import Button from '@/components/auth/Button.vue';
import Group from '@/components/panel/admin/admins/Group.vue';
import Layout from '@/components/panel/admin/admins/Layout.vue';
import { onMounted, ref } from 'vue';
import { useItemStore } from '@/stores/admin/admins.js';

const store = useItemStore();
const f2a = ref(1);

onMounted(async () => {
	store.clearError();
	store.item = 'null';
	store.item_image = null;
});
</script>

<template>
	<Layout :message="store.getMessage" :error="store.getError">
		<Group title="Admins" desc="Here you can create admin.">
			<form action="post" @submit.prevent="store.createItem" enctype="multipart/form-data">
				<Label text="Name" />
				<Input name="name" />
				<Label text="Email" />
				<Input name="email" />
				<Label text="Enable 2FA" />
				<YesNo name="f2a" v-model="f2a" />
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
