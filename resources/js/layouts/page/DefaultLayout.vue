<script setup>
import ChangeDescription from '@/components/utils/head/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/head/ChangeTitle.vue';
import Header from '@/components/page/Header.vue';
import Footer from '@/components/page/Footer.vue';

const props = defineProps({
	title: String,
	description: String,
});
</script>
<template>
	<ChangeTitle :title="props.title" />
	<ChangeDescription :description="props.description" />

	<div class="default_layout">
		<div class="page_header">
			<div class="page_header_wrapper">
				<slot name="header">
					<Header />
				</slot>
			</div>
		</div>

		<div class="page_content">
			<div class="page_content_wrapper">
				<slot>Content</slot>
			</div>
		</div>

		<div class="page_footer">
			<slot name="footer">
				<Footer />
			</slot>
		</div>
	</div>
</template>

<style>
@import url('@/assets/css/main.css');
@import url('@/assets/css/page/main.css');
@import url('@/assets/css/page/subscribe.css');
</style>
