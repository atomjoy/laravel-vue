<script setup>
import IconEdit from '@/assets/icons/IconEdit.vue';
import IconTrash from '@/assets/icons/IconTrash.vue';
import { useItemStore } from '@/stores/admin/subscribers.js';

const store = useItemStore();
const props = defineProps({
	item: { default: null },
});
</script>

<template>
	<td class="panel_list_title">
		<span class="panel_list_col_id">{{ item.id }}</span>
	</td>
	<td style="min-width: 40%">
		<a :href="'mailto:' + item.email" class="panel_list_item_link" target="_blank">
			{{ item.email }}
		</a>
	</td>
	<td>
		{{ item.name }}
	</td>
	<td>
		<span v-if="item.is_approved" class="span_btn span_btn_green">{{ $t('approved') }}</span>
		<span v-if="!item.is_approved" class="span_btn span_btn_red">{{ $t('blocked') }}</span>
	</td>
	<td>
		<RouterLink class="panel_list_action_link" :to="'/admin/subscribers/edit/' + item.id" :title="$t('Edit')">
			<IconEdit />
		</RouterLink>

		<div @click="store.deleteItem(item.id)" class="panel_list_action_link" :title="$t('Delete')">
			<IconTrash />
		</div>
	</td>
</template>
