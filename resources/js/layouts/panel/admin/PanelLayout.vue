<script setup>
import NavbarLeft from '@/components/panel/admin/NavbarLeft/NavbarLeft.vue';
import NavbarTop from '@/components/panel/admin/NavbarTop/NavbarTop.vue';
import NavbarFooter from '@/components/panel/admin/NavbarFooter/NavbarFooter.vue';

const props = defineProps({
	title: { type: String, default: 'Dashboard' },
});
</script>

<template>
	<div class="panel_layout">
		<div class="panel_layout_header">
			<slot name="header">
				<NavbarTop :title="props.title" />
			</slot>
		</div>

		<div class="panel_layout_main">
			<slot></slot>
		</div>

		<div class="panel_layout_footer">
			<slot name="footer">
				<NavbarFooter />
			</slot>
		</div>
	</div>

	<div class="panel_layout_leftbar">
		<slot name="leftbar">
			<NavbarLeft />
		</slot>
	</div>
</template>

<style>
@import url('@/assets/css/main.css');
</style>
