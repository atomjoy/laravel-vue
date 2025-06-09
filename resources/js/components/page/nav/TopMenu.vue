<script setup>
import IconHamburger from '@/assets/icons/IconHamburger.vue';
import IconClose from '@/assets/icons/IconClose.vue';
import TopMenuLinks from './TopMenuLinks.vue';
import { ref } from 'vue';

const open = ref(false);

function toggle() {
	open.value == true ? (open.value = false) : (open.value = true);
}
</script>
<template>
	<div class="page_top_menu_wrapper" @click="toggle">
		<div class="page_header_menu_btn">
			<IconHamburger />
		</div>
		<div class="page_top_menu" :class="{ page_top_menu_open: open }">
			<nav>
				<div class="page_top_menu_btn_close" @click.stop="toggle">
					<IconClose />
				</div>
				<slot>
					<TopMenuLinks />
				</slot>
			</nav>
		</div>
	</div>
</template>
