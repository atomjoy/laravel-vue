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

async function subscribe() {
	message.value = '';
	try {
		let data = new FormData();
		data.append('email', email.value);
		let res = await axios.post('/web/api/page/subscribe', data);
		message.value = t(res.data.message);
		error.value = false;
	} catch (err) {
		error.value = true;
		message.value = t(err.response.data.message) ?? t('Not subscribed!');
	}
}
</script>

<template>
	<Layout title="Subscribe" description="Subscribe to newsletter.">
		<div class="page_subscribe">
			<h1>{{ $t('Subscribe') }}</h1>

			<div class="page_message" :class="{ page_error: error }" v-if="message">{{ message }}</div>

			<input type="text" v-model="email" :placeholder="$t('Email address')" />

			<i class="fa-regular fa-paper-plane" @click="subscribe">
				<span>{{ $t('Send') }}</span>
			</i>
		</div>
	</Layout>

	<ChangeTitle :title="$t('Subscribe')" />
	<ChangeDescription :description="$t('Subscribe to newsletter.')" />
</template>

<style>
@import url('@/assets/css/page/subscribe.css');
</style>
