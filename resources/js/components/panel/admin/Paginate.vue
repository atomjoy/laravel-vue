<script setup>
import { ref } from 'vue';

const props = defineProps({
	store: null,
});
</script>

<template>
	<div class="panel_list_links" v-if="props.store.list.length > 0">
		<div class="panel_paginate_link" @click="props.store.prevPage" v-if="props.store.current_page > 1"><</div>
		<div class="panel_paginate_link panel_paginate_link_active">
			{{ props.store.current_page }}
		</div>
		<div class="panel_paginate_link" @click="props.store.nextPage" v-if="props.store.current_page < props.store.last_page">></div>
	</div>
</template>

<style>
.active {
	color: #fff;
	background: #09f;
}
</style>
