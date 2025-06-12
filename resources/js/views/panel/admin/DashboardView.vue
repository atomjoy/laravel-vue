<script setup>
import IconEvent from '@/assets/icons/IconBallon.vue';
import IconComment from '@/assets/icons/IconComment.vue';
import PanelLayout from '@/layouts/panel/admin/PanelLayout.vue';
import { useAuthStore } from '@/stores/auth.js';
import { ref } from 'vue';

const auth = useAuthStore();
let user = auth.getUser;
let count_articles = ref(0);
let count_comments = ref(0);
let count_contacts = ref(0);
let count_subscribers = ref(0);

async function countComments() {
	const res = await axios.get('/web/api/admin/comments/count/' + user.value.id);
	count_comments.value = res?.data?.count ?? 0;
}

async function countArticles() {
	const res = await axios.get('/web/api/admin/articles/count/' + user.value.id);
	count_articles.value = res?.data?.count ?? 0;
}

async function countContacts() {
	const res = await axios.get('/web/api/admin/contacts/count');
	count_contacts.value = res?.data?.count ?? 0;
}

async function countSubscribers() {
	const res = await axios.get('/web/api/admin/subscribers/count');
	count_subscribers.value = res?.data?.count ?? 0;
}

countContacts();
countSubscribers();
</script>

<template>
	<PanelLayout title="Dashboard">
		<div class="dashboard">
			<div class="dashboard_user">
				<div class="dashboard_user_info">
					<div class="dashboard_user_info_text">
						{{ $t('Welcome') }}
					</div>
					<div class="dashboard_user_info_name">{{ user.name }}</div>
					<div class="dashboard_user_info_email">
						{{ user.email }}
					</div>
				</div>

				<div class="dashboard_user_events">
					<div class="dashboard_user_events_icon">
						<IconEvent />
					</div>
					<div class="dashboard_user_events_count">{{ count_subscribers }}</div>
					<div class="dashboard_user_events_text">
						{{ $t('Number of subscribers') }}
					</div>
				</div>

				<div class="dashboard_user_events">
					<div class="dashboard_user_events_icon">
						<IconComment />
					</div>
					<div class="dashboard_user_events_count">{{ count_contacts }}</div>
					<div class="dashboard_user_events_text">
						{{ $t('Number of contacts') }}
					</div>
				</div>
			</div>
		</div>
	</PanelLayout>
</template>

<style>
@import url('@/assets/css/panel/dashboard.css');
</style>
