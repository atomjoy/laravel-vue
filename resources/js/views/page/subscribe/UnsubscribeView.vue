<script setup>
import ChangeDescription from '@/components/utils/head/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/head/ChangeTitle.vue';
import Layout from '@/layouts/page/DefaultLayout.vue';
import axios from 'axios';
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';

const { t, locale } = useI18n({ useScope: 'global' });
const email = ref('');
const message = ref('');
const error = ref('false');

async function unsubscribe() {
	message.value = '';
	try {
		if (email.value) {
			let res = await axios.get('/web/api/page/subscribe/remove/' + email.value);
			message.value = t(res.data.message);
			error.value = false;
		} else {
			error.value = true;
			message.value = t('Invalid email address.');
		}
	} catch (err) {
		error.value = true;
		message.value = t(err.response.data.message) ?? t('Email has not been removed.');
	}
}
</script>

<template>
	<Layout title="Unsubscribe" description="Unsubscribe from newsletter.">
		<div class="page_subscribe">
			<h1>{{ $t('Unsubscribe') }}</h1>

			<div class="page_message" :class="{ page_error: error }" v-if="message">{{ message }}</div>

			<input type="text" v-model="email" :placeholder="$t('Email address')" />

			<i class="fa-regular fa-paper-plane" @click="unsubscribe">
				<span>{{ $t('Send') }}</span>
			</i>
		</div>
	</Layout>

	<ChangeTitle :title="$t('Unsubscribe')" />
	<ChangeDescription :description="$t('Unsubscribe from newsletter.')" />
</template>

<style>
@import url('@/assets/css/page/subscribe.css');
</style>
