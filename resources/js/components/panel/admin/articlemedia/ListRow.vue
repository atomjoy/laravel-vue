<script setup>
import IconEdit from '@/assets/icons/IconEdit.vue';
import IconTrash from '@/assets/icons/IconTrash.vue';
import { useItemStore } from '@/stores/admin/articlemedia.js';

const store = useItemStore();

const props = defineProps({
	item: { default: null },
});
</script>

<template>
	<td class="panel_list_title">
		<span class="panel_list_col_id">{{ item.id }}</span>
	</td>
	<td>
		<a :href="'/img/show?path=' + item.path" class="panel_list_item_link" target="_blank">
			<img class="panel_list_image" :src="'/img/show?path=' + item.path" onerror="this.remove()" />
		</a>
	</td>
	<td>
		<a :href="'/img/show?path=' + item.path" class="panel_list_item_link" target="_blank">
			{{ item.title }}
		</a>
	</td>
	<td>
		{{ item.author.name }}
	</td>
	<td>
		<RouterLink class="panel_list_action_link" :to="'/admin/articlemedia/edit/' + item.id" :title="$t('Edit')">
			<IconEdit />
		</RouterLink>

		<div @click="store.deleteItem(item.id)" class="panel_list_action_link" :title="$t('Delete')">
			<IconTrash />
		</div>
	</td>
</template>
