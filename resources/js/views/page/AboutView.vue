<script setup>
import ChangeDescription from '@/components/utils/head/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/head/ChangeTitle.vue';
import Layout from '@/layouts/page/DefaultLayout.vue';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import { useI18n } from 'vue-i18n';

onMounted(async () => {
	// const { t, locale } = useI18n({ useScope: 'global' });
	// const route = useRoute();
	// const params = route.params;
	// const message = ref('');
	// try {
	// 	let res = await axios.get('/web/api/page/load');
	// 	message.value = t(res.data.message);
	// } catch (err) {
	// 	console.log(t(err.response.data.message));
	// }
});
</script>

<template>
	<Layout title="About" description="Our about page.">
		<div class="page_wrapper">
			<h1>{{ $t('About') }}</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro incidunt sapiente, aspernatur saepe quasi facere illo animi velit iusto voluptate unde voluptatibus fugiat dolores nulla in quos dolore, temporibus nesciunt.</p>
		</div>
	</Layout>

	<ChangeTitle :title="$t('About')" />
	<ChangeDescription :description="$t('Our about page.')" />
</template>
