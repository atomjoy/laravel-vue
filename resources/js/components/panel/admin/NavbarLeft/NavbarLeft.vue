<script setup>
import NavbarLayout from './NavbarLayout.vue';
import AdminLinks from './AdminNavbarLinks.vue';
</script>

<template>
	<NavbarLayout>
		<div class="panel_navbar_links">
			<slot><AdminLinks /></slot>
		</div>
	</NavbarLayout>
</template>
