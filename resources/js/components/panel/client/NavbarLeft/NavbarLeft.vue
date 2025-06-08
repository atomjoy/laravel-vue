<script setup>
import NavbarLayout from './NavbarLayout.vue';
import ClientLinks from './ClientNavbarLinks.vue';
</script>

<template>
	<NavbarLayout>
		<div class="panel_navbar_links">
			<slot><ClientLinks /></slot>
		</div>
	</NavbarLayout>
</template>
