<script setup>
import { RouterLink, useRoute } from 'vue-router';
import IconHome from '@/assets/icons/IconHome.vue';

const route = useRoute();

const props = defineProps({
	to: { type: String, default: '/admin/dashboard' },
	text: { type: String, default: 'Dashboard' },
});
</script>

<template>
	<RouterLink :to="props.to" class="panel_navbar_link" :class="{ 'router-link-active': route.path.includes(props.to) }">
		<slot>
			<IconHome />
		</slot>
		<span>{{ $t(props.text) }}</span>
	</RouterLink>
</template>
