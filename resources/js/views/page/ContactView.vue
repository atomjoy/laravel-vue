<script setup>
import ChangeDescription from '@/components/utils/head/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/head/ChangeTitle.vue';
import Layout from '@/layouts/page/DefaultMapLayout.vue';
import Contact from '@/components/page/contact/Contact.vue';
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
	<Layout title="Contact" description="Our contact page.">
		<Contact />
	</Layout>

	<!-- Seo header meta -->
	<!-- <AddMeta :json="JSON.stringify(meta)" />
	<AddSchema :json="JSON.stringify(schema)" /> -->

	<ChangeTitle :title="$t('Contact')" />
	<ChangeDescription :description="$t('Our contact page.')" />
</template>
