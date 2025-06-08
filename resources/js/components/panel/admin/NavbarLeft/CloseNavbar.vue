<script setup>
import Icon from '@/assets/icons/IconCloseBox.vue';

function close() {
	const el = document.querySelector('.panel_layout_leftbar');
	el.classList.remove('open_navbar');
}
</script>

<template>
	<Icon class="navbar__close" @click="close" />
</template>
