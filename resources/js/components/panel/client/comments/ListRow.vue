<script setup>
import IconEdit from '@/assets/icons/IconEdit.vue';
import IconTrash from '@/assets/icons/IconTrash.vue';
import { useItemStore } from '@/stores/client/comments.js';

const store = useItemStore();
const props = defineProps({
	item: { default: null },
});
</script>

<template>
	<td>
		<span class="panel_list_col_id">{{ item.id }}</span>
	</td>
	<td style="min-width: 50%">
		<div class="panel_list_comment_content">
			{{ item.content }}
		</div>
	</td>
	<!-- <td>
		<a :href="'/article/' + item.article.slug" target="_blank">
			<span class="span_author" :title="'ID:' + item.author.id + ' IP: ' + item.ip_address + ' Article: ' + item.article.title">{{ item.author.name }}</span>
		</a>
		<span v-if="item.commentable_type == 'App\\Models\\Admin'" class="span_btn">{{ $t('Author') }}</span>
		<span v-if="item.commentable_type == 'App\\Models\\User'" class="span_btn">{{ $t('Client') }}</span>
	</td> -->
	<td>
		<span v-if="item.is_approved" class="span_btn span_btn_green">{{ $t('approved') }}</span>
		<span v-if="!item.is_approved" class="span_btn span_btn_red">{{ $t('blocked') }}</span>
	</td>
	<td>
		<RouterLink class="panel_list_action_link" :to="'/panel/comments/edit/' + item.id" :title="$t('Edit')">
			<IconEdit />
		</RouterLink>

		<div @click="store.deleteItem(item.id)" class="panel_list_action_link" :title="$t('Delete')">
			<IconTrash />
		</div>
	</td>
</template>
