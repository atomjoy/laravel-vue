<script setup>
import IconChevron from '@/assets/icons/IconArrowDown.vue';
import UserAvatar from './UserAvatar.vue';

const props = defineProps({
	open: { default: false },
	image: { default: '/default/avatar.webp' },
});
</script>

<template>
	<UserAvatar :image="props.image" />
	<IconChevron :class="{ user_info_rotate_chevron: props.open }" />
</template>
