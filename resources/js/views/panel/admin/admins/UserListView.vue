<script setup>
import Layout from '@/components/panel/admin/admins/Layout.vue';
import ListRow from '@/components/panel/admin/admins/ListRow.vue';
import Group from '@/components/panel/admin/admins/GroupList.vue';
import Paginate from '@/components/panel/admin/Paginate.vue';
import TableNoRecords from '@/components/utils/alerts/TableNoRecords.vue';
import { useRoute } from 'vue-router';
import { onMounted, watch } from 'vue';
import { useItemStore } from '@/stores/admin/admins.js';

const store = useItemStore();
const route = useRoute();

onMounted(() => {
	store.clearError();
	store.current_page = route.query.page ?? 1;
	store.loadList();
});

watch(
	() => route.query.page,
	(newId, oldId) => {
		store.current_page = route.query.page ?? 1;
		store.loadList();
	}
);
</script>

<template>
	<Layout :message="store.getMessage" :error="store.getError">
		<Group title="Admins" desc="Administrators list.">
			<table class="panel_table_list">
				<tbody>
					<tr class="panel_list_header">
						<th scope="col" class="panel_list_title">{{ $t('ID') }}</th>
						<th scope="col" class="panel_list_title">{{ $t('Image') }}</th>
						<th scope="col" class="panel_list_title">{{ $t('Name') }}</th>
						<th scope="col" class="panel_list_title">{{ $t('Email') }}</th>
						<th scope="col" class="panel_list_title">{{ $t('2FA') }}</th>
						<th scope="col" class="panel_list_title panel_list_title_last">{{ $t('Action') }}</th>
					</tr>

					<tr v-for="i in store.list" :key="i.id" class="panel_list_row" :class="'panel_list_row_' + i.id">
						<ListRow :item="i" />
					</tr>

					<TableNoRecords :show="store.list.length == 0" />
				</tbody>
			</table>

			<Paginate :store="store" />
		</Group>
	</Layout>
</template>
