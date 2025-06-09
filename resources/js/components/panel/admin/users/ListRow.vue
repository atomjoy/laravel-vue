<script setup>
import IconEdit from '@/assets/icons/IconEdit.vue';
import IconTrash from '@/assets/icons/IconTrash.vue';
import { useItemStore } from '@/stores/admin/users.js';

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
		<a :href="'/img/avatar?path=' + item.avatar" class="panel_list_item_link" target="_blank">
			<img class="panel_list_avatar" :src="'/img/avatar?path=' + item.avatar" onerror="this.remove()" />
		</a>
	</td>
	<td>
		{{ item.name }}
	</td>
	<td>
		<div>
			<a :href="'mailto:' + item.email" class="panel_list_item_link" target="_blank">{{ item.email }}</a>
		</div>
		<div>
			<a :href="'tel:+' + item.mobile_prefix + item.mobile" class="panel_list_item_link" target="_blank">+{{ item.mobile_prefix + ' ' + item.mobile }}</a>
		</div>
	</td>
	<td>
		<span v-if="item.f2a" class="span_btn span_btn_green">{{ $t('enabled') }}</span>
		<span v-if="!item.f2a" class="span_btn span_btn_red">{{ $t('disabled') }}</span>
	</td>
	<td>
		<RouterLink class="panel_list_action_link" :to="'/admin/users/edit/' + item.id" :title="$t('Edit')">
			<IconEdit />
		</RouterLink>

		<div @click="store.deleteItem(item.id)" class="panel_list_action_link" :title="$t('Delete')">
			<IconTrash />
		</div>
	</td>
</template>
