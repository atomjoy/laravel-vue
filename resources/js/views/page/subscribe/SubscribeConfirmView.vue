<script setup>
import ChangeDescription from '@/components/utils/head/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/head/ChangeTitle.vue';
import Layout from '@/layouts/page/DefaultLayout.vue';
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import { useI18n } from 'vue-i18n';

const { t, locale } = useI18n({ useScope: 'global' });
const route = useRoute();
const id = route.params.id ?? 0;
const error = ref('false');
const message = ref('');

onMounted(async () => {
	message.value = '';
	try {
		if (id) {
			let res = await axios.get('/web/api/page/subscribe/confirm/' + id);
			message.value = t(res.data.message);
			error.value = false;
		} else {
			error.value = true;
			message.value = t('Invalid subscriber id.');
		}
	} catch (err) {
		error.value = true;
		message.value = t(err.response.data.message) ?? t('Confirmation error.');
	}
});
</script>

<template>
	<Layout title="Subscribe" description="Subscribe to newsletter.">
		<div class="page_subscribe">
			<h1>{{ $t('Subscribe') }}</h1>
			<div class="page_message" :class="{ page_error: error }" v-if="message">{{ message }}</div>
		</div>
	</Layout>

	<ChangeTitle :title="$t('Subscribe')" />
	<ChangeDescription :description="$t('Subscribe to newsletter.')" />
</template>

<style>
@import url('@/assets/css/page/subscribe.css');
</style>
