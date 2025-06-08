<script setup>
import Icon from '@/assets/icons/IconHamburger.vue';

function open() {
	const el = document.querySelector('.panel_layout_leftbar');
	el.classList.add('open_navbar');
}
</script>

<template>
	<Icon class="navbar__open" @click="open" />
</template>
