<script setup>
import IconEdit from '@/assets/icons/IconEdit.vue';
import IconTrash from '@/assets/icons/IconTrash.vue';
import { useItemStore } from '@/stores/admin/contacts.js';

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
		{{ item.subject }}
	</td>
	<td>{{ item.firstname }} {{ item.lastname }}</td>
	<td>
		<div>
			<a :href="'mailto:' + item.email" class="panel_list_item_link" target="_blank">{{ item.email }}</a>
		</div>
		<div>
			<a :href="'tel:' + item.mobile" class="panel_list_item_link" target="_blank">{{ item.mobile }}</a>
		</div>
	</td>
	<td>
		<RouterLink class="panel_list_action_link" :to="'/admin/contacts/edit/' + item.id" :title="$t('Edit')">
			<IconEdit />
		</RouterLink>

		<div @click="store.deleteItem(item.id)" class="panel_list_action_link" :title="$t('Delete')">
			<IconTrash />
		</div>
	</td>
</template>
