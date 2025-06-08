<script setup>
import IconEvent from '@/assets/icons/IconBallon.vue';
import IconComment from '@/assets/icons/IconComment.vue';
import PanelLayout from '@/layouts/panel/client/PanelLayout.vue';
import { useAuthStore } from '@/stores/auth.js';
import axios from 'axios';
import { ref } from 'vue';
const auth = useAuthStore();
let user = auth.getUser;
let comments = ref(0);
let events = ref(0);

async function countComments() {
	const res = await axios.get('/web/api/comments/count/' + user.value.id);
	comments.value = res?.data?.count ?? 0;
}
async function countEvents() {
	const res = await axios.get('/web/api/events/count/' + user.value.id);
	events.value = res?.data?.count ?? 0;
}

countComments();
countEvents();
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
					<div class="dashboard_user_events_count">{{ events }}</div>
					<div class="dashboard_user_events_text">
						{{ $t('Number of orders') }}
					</div>
				</div>

				<div class="dashboard_user_events">
					<div class="dashboard_user_events_icon">
						<IconComment />
					</div>
					<div class="dashboard_user_events_count">{{ comments }}</div>
					<div class="dashboard_user_events_text">
						{{ $t('Total number of comments') }}
					</div>
				</div>
			</div>
		</div>
	</PanelLayout>
</template>

<style>
@import url('@/assets/css/panel/dashboard.css');
</style>
