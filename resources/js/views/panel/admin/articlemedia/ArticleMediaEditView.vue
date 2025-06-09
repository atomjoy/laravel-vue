<script setup>
import Label from '@/components/auth/Label.vue';
import Input from '@/components/auth/Input.vue';
import Button from '@/components/auth/Button.vue';
import Group from '@/components/panel/admin/articlemedia/Group.vue';
import Layout from '@/components/panel/admin/articlemedia/Layout.vue';
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { useItemStore } from '@/stores/admin/articlemedia.js';

const store = useItemStore();
const route = useRoute();
const id = route.params.id;

onMounted(async () => {
	store.clearError();
	await store.loadItem(id);
	// console.log('Update', id, store.item);
});

function onSubmit(e) {
	store.updateItem(id, new FormData(e.target));
}
</script>

<template>
	<Layout :message="store.getMessage" :error="store.getError" :edit="true">
		<Group title="Update file" desc="Here you can upload image.">
			<form action="post" @submit.prevent="onSubmit" enctype="multipart/form-data">
				<Label text="Title" />
				<Input name="title" v-model="store.item.title" />
				<Label text="Image" />
				<Input type="file" name="file" id="panel_item_input" @change="store.getImagePath" />
				<div class="panel_item_image" v-if="store.item.path">
					<div class="panel_item_remove" @click="store.removeImage(store.item.id)">
						{{ $t('Delete') }}
					</div>
					<img id="img" :src="'/img/show?path=' + store.item.path" onerror="this.remove()" />
				</div>
				<Button text="Update" class="settings_button" />
			</form>
		</Group>
	</Layout>
</template>
