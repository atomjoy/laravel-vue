<script setup>
import ChangeTheme from '@/components/utils/head/ChangeTheme.vue';
import ChangeLocale from '@/components/utils/head/ChangeLocale.vue';
import TopMenu from '@/components/page/nav/TopMenu.vue';
</script>

<template>
	<div class="page_header_menu">
		<RouterLink to="/" class="blog_header_link">
			<img src="/default/logo/logo-light.png" class="blog_header_logo" alt="Logo" />
		</RouterLink>
		<TopMenu />
		<ChangeTheme />
		<ChangeLocale />
	</div>
</template>
