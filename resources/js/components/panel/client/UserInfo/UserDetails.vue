<script setup>
import UserAvatar from './UserAvatar.vue';

const props = defineProps({
	name: { default: 'Unknown' },
	email: { default: 'unknown@example.com' },
	image: { default: '/default/avatar.webp' },
});
</script>

<template>
	<div class="user_info">
		<UserAvatar :image="props.image" />

		<div class="user_info_details">
			<div class="user_info_name">{{ props.name }}</div>
			<div class="user_info_email">{{ props.email }}</div>
		</div>
	</div>
</template>
