<script setup>
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';
import { RouterLink } from 'vue-router';
import ScrollBar from '@/components/page/ScrollBar.vue';
import company from '@/settings/company.json';

const { t, locale } = useI18n({ useScope: 'global' });

const email = ref('');
const error = ref('');

async function subscribe() {
	error.value = '';

	try {
		let data = new FormData();
		data.append('email', email.value);
		let res = await axios.post('/web/api/page/subscribe', data);
		error.value = t(res.data.message);
	} catch (err) {
		error.value = t(err.response.data.message) ?? t('Not subscribed!');
	}
}
</script>
<template>
	<ScrollBar />

	<div class="page_footer_wrapper">
		<div class="page_footer_top">
			<div class="page_footer_top_title">
				<span>{{ $t("Let's") }}</span> <span class="page_footer_accent">{{ $t('Connect') }}</span>
			</div>
			<div class="page_footer_top_btn">
				<RouterLink to="/contact" :title="$t('Contact Us')">
					<span>{{ $t('Contact Us') }}</span>
				</RouterLink>
				<i class="fa-solid fa-arrow-right"></i>
			</div>
		</div>

		<div class="page_footer_mid">
			<div class="page_footer_left">
				<div class="page_footer_logo">
					<img src="/default/logo/logo-light.png" class="blog_footer_logo" alt="Logo" />
				</div>

				<div class="page_footer_company">{{ company.name }}</div>

				<div class="page_footer_about">{{ company.desc }}</div>

				<div class="page_footer_social" v-for="i in company.socials">
					<a :href="i.url" :title="i.title">
						<i :class="['fa-brands', 'fa-' + i.icon]"></i>
					</a>
				</div>
			</div>

			<div class="page_footer_center">
				<div class="page_footer_center_group">
					<div class="page_footer_link_group">{{ $t('Navigation') }}</div>
					<div class="page_footer_link">
						<RouterLink to="/home">{{ $t('Home') }}</RouterLink>
					</div>
					<div class="page_footer_link">
						<RouterLink to="/about" :title="$t('About')">{{ $t('About') }}</RouterLink>
					</div>
					<div class="page_footer_link">
						<RouterLink to="/contact" :title="$t('Contact')">{{ $t('Contact') }}</RouterLink>
					</div>
					<div class="page_footer_link">
						<RouterLink to="/faqs" :title="$t('FAQs')">{{ $t('FAQs') }}</RouterLink>
					</div>

					<!-- <div class="page_footer_link">
						<RouterLink to="/services" :title="$t('Services')">{{ $t('Services') }}</RouterLink>
					</div>
					<div class="page_footer_link">
						<RouterLink to="/projects" :title="$t('Projects')">{{ $t('Projects') }}</RouterLink>
					</div>
					<div class="page_footer_link">
						<RouterLink to="/career" :title="$t('Career')">{{ $t('Careers') }}</RouterLink>
					</div>
					<div class="page_footer_link">
						<RouterLink to="/testimonials" :title="$t('Testimonials')">{{ $t('Testimonials') }}</RouterLink>
					</div> -->
				</div>

				<div class="page_footer_center_group">
					<div class="page_footer_link_group">{{ $t('Contact') }}</div>
					<div class="page_footer_link">
						<a :href="'tel:' + company.mobile" :title="$t('Mobile')" target="_blank">{{ company.mobile }}</a>
					</div>
					<div class="page_footer_link">
						<a :href="company.website_url" :title="$t('Website')" target="_blank">{{ company.website }}</a>
					</div>
					<div class="page_footer_link">
						<a :href="'mailto:' + company.email" :title="$t('Contact email')" target="_blank">{{ company.email }}</a>
					</div>
					<div class="page_footer_link">
						<a :href="'https://google.pl/search?q=' + company.country + ',' + company.city + ',' + company.street" :title="$t('Location')" target="_blank">
							{{ company.country }} <br />
							{{ company.city }} <br />
							{{ company.street }} <br />
						</a>
					</div>
				</div>
			</div>

			<div class="page_footer_right">
				<div class="page_footer_link_group">{{ $t('Get the latest info') }}</div>
				<div class="page_footer_subscribe">
					<input type="text" v-model="email" :placeholder="$t('Email address')" />
					<i class="fa-regular fa-paper-plane" @click="subscribe"></i>
				</div>
				<div class="page_footer_error">{{ error }}</div>
			</div>
		</div>

		<div class="page_footer_bot">
			<div class="page_footer_rights">
				{{ $t('Copyrights: 2025') }} <span class="page_footer_accent">{{ company.name }}</span> {{ $t('All rights reserved.') }}
			</div>
			<div class="page_footer_policy">
				<RouterLink to="/docs/terms">{{ $t('Terms & Conditions') }}</RouterLink>
				|
				<RouterLink to="/docs/policy">{{ $t('Privacy Policy') }}</RouterLink>
			</div>
		</div>
	</div>
</template>

<style>
.page_footer_accent {
	color: var(--accent);
}

.page_footer_company {
	font-size: 25px;
	font-weight: 700;
	padding-block: 20px;
	color: var(--accent);
}

.page_footer_social {
	float: left;
	display: inline;
	margin-top: 20px;
	margin-right: 20px;
	font-size: 25px;
}

.page_footer_social a {
	color: var(--accent) !important;
}

.page_footer_social a:hover {
	color: var(--accent-hover) !important;
}

.page_footer_wrapper {
	margin: 0 auto;
	width: 90%;
	height: auto;
	max-width: 1280px;
	min-height: 320px;
}

.blog_footer_logo {
	height: 60px;
	min-width: 60px;
	margin: 10px;
	margin-left: 0px;
}

img.blog_footer_logo {
	content: var(--logo);
	min-width: 60px;
}

.page_footer_top {
	padding-block: 30px;
	overflow: hidden;
	border-bottom: 1px solid var(--border);
}

.page_footer_top_title {
	float: left;
	display: inline;
	font-size: 30px;
	font-weight: 700;
	color: var(--text-1);
}

.page_footer_top_btn {
	float: right;
	overflow: hidden;
	display: inline;
	font-size: 16px;
	font-weight: 600;
	color: var(--text-1);
	background: var(--bg-3);
	border-radius: 50px;
}

.page_footer_top_btn span {
	float: left;
	height: auto;
	margin-right: 10px;
	color: #fff;
	background: var(--accent);
	padding: 10px 25px;
	border-radius: 50px;
}

.page_footer_top_btn i {
	float: left;
	height: auto;
	color: var(--accent);
	background: var(--text-1);
	margin: 5px;
	padding: 10px;
	border-radius: 50%;
}

.page_footer_mid {
	padding-block: 30px;
	overflow: hidden;
	display: flex;
	align-items: left;
}

.page_footer_left {
	float: left;
	width: 60%;
}

.page_footer_center {
	float: left;
	width: 100%;
	display: flex;
	align-items: left;
	padding-inline: 90px;
}

.page_footer_right {
	float: left;
	width: 50%;
}

.page_footer_center > div {
	width: 100%;
	padding-inline: 20px;
}

.page_footer_link_group {
	color: var(--accent);
	font-weight: 700;
	margin-top: 10px;
	margin-bottom: 20px;
}

.page_footer_link {
	color: var(--text-1);
	margin-bottom: 10px;
}

.page_footer_link a {
	color: var(--text-1) !important;
}

.page_footer_link a:hover {
	color: var(--accent) !important;
}

.page_footer_bot {
	padding-block: 30px;
	overflow: hidden;
	border-top: 1px solid var(--border);
}

.page_footer_bot > div {
	display: inline;
}

.page_footer_policy {
	float: right;
	color: var(--text-1);
}

.page_footer_policy a {
	color: var(--text-1) !important;
}

.page_footer_policy a:hover {
	color: var(--accent) !important;
}

.page_footer_subscribe {
	position: relative;
}

.page_footer_subscribe input {
	float: left;
	width: 100%;
	padding: 15px;
	font-size: 14px;
	letter-spacing: 1px;
	color: var(--text-1);
	background: var(--bg-2);
	border: 0px solid var(--border);
	border-radius: 50px;
}

.page_footer_subscribe input::placeholder {
	color: var(--input-label) !important;
}

.page_footer_subscribe i {
	position: absolute;
	top: 5px;
	right: 5px;
	padding: 12px;
	color: #fff;
	background: var(--accent);
	border-radius: 50px;
	z-index: 1;
	cursor: pointer;
}

.page_footer_subscribe i:hover {
	color: #fff;
	background: var(--text-1);
	cursor: pointer;
}

.page_footer_error {
	float: left;
	width: 100%;
	padding-block: 10px;
	margin-top: 10px;
}

@media all and (max-width: 1024px) {
	.page_footer_mid {
		display: block;
	}

	.page_footer_center,
	.page_footer_center_group,
	.page_footer_right {
		width: 100%;
		margin-top: 30px;
		padding-inline: 0px !important;
	}

	.page_footer_left {
		width: 100%;
		margin-top: 0px;
		padding-inline: 0px !important;
	}

	.page_footer_policy {
		float: left;
		margin-top: 20px;
	}
}
</style>
