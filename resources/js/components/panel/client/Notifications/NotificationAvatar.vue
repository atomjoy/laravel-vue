<template>
	<img class="notify_owner_avatar_image" :src="avatar_path" onerror="this.onerror = false; this.src='/default/avatar.webp'" />
</template>

<script setup>
import { ref } from 'vue';
const avatar_path = ref(null);
const props = defineProps({
	image: { default: '' },
});

if (props.image) {
	avatar_path.value = '/img/avatar?path=' + props.image;
} else {
	avatar_path.value = '/default/avatar.webp';
}
</script>
