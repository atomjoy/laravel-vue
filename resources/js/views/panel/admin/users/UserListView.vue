<script setup>
import Layout from '@/components/panel/admin/users/Layout.vue';
import ListRow from '@/components/panel/admin/users/ListRow.vue';
import Group from '@/components/panel/admin/users/GroupList.vue';
import Paginate from '@/components/panel/admin/Paginate.vue';
import PaginateCustom from '@/components/panel/admin/PaginateCustom.vue';
import TableNoRecords from '@/components/utils/alerts/TableNoRecords.vue';
import { useRoute } from 'vue-router';
import { onMounted, ref, watch } from 'vue';
import { useItemStore } from '@/stores/admin/users.js';

const store = useItemStore();
const route = useRoute();

const search = ref('');

onMounted(async () => {
	store.clearError();
	store.current_page = route.query.page ?? 1;
	await store.loadList(search.value);
});

watch(
	() => route.query.page,
	async (newId, oldId) => {
		store.current_page = route.query.page ?? 1;
		await store.loadList(search.value);
	}
);

async function setPage(page) {
	store.current_page = page;
	await store.loadList(search.value);
}

async function searchText() {
	store.current_page = route.query.page ?? 1;
	await store.loadList(search.value);
}
</script>

<template>
	<Layout :message="store.getMessage" :error="store.getError">
		<Group title="Users" desc="Customers list.">
			<input class="panel_search_input" type="text" v-model="search" @keyup="searchText" placeholder="Search" />

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

			<!-- <Paginate :store="store" /> -->
			<PaginateCustom v-if="store.list.length != 0" :current_page="Number(store.current_page)" :last_page="Number(store.last_page)" @page="setPage" />
		</Group>
	</Layout>
</template>
