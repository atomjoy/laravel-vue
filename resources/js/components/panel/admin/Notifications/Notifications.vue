<script setup>
import NotificationMessages from './NotificationMessages.vue';
import IconLoadMore from '@/assets/icons/IconLoadMore.vue';
import IconMarkAll from '@/assets/icons/IconMarkAll.vue';
import IconClose from '@/assets/icons/IconCloseBox.vue';
import IconBell from '@/assets/icons/IconBell.vue';
import { ref, onMounted } from 'vue';
import { useNotifyStore } from '@/stores/notifications/admin.js';

const store = useNotifyStore();

let open = ref(false);

onMounted(async () => {
	await store.loadPage();
});

function toggle() {
	open.value = !open.value;
}

function checkUnread() {
	console.log('Unread', store.unread);
	return store.unread > 0;
}

function readAll() {
	store.markAsReadAll();
	// document.querySelectorAll('.notify-item').forEach((e) => {
	// 	e.classList.add('notify-item-read')
	// })
}

function nextPage() {
	store.loadPage();
}
</script>

<template>
	<div class="user_notification_layout">
		<div class="user_notification_layout_icon" @click="toggle">
			<span class="dot" v-if="checkUnread()"></span>
			<IconBell />
		</div>

		<div class="user_notification_layout_popup" v-if="open">
			<div class="user_notification_layout_top">
				<div class="user_notification_layout_top_title">
					{{ $t('Notifications') }}
				</div>

				<IconClose @click="toggle" class="user_notification_layout_close" />
			</div>

			<div class="user_notification_layout_content">
				<slot>
					<NotificationMessages />
				</slot>
			</div>

			<div class="user_notification_layout_bot">
				<div class="user_notification_layout_load" @click="nextPage">
					<IconLoadMore class="user_notification_layout_load_icon" />
					<span>{{ $t('Load more') }}</span>
				</div>

				<div class="user_notification_layout_load" @click="readAll">
					<IconMarkAll class="user_notification_layout_load_icon" />
					<span>{{ $t('Mark all as read') }}</span>
				</div>
			</div>
		</div>
	</div>
</template>

<style>
@import url('@/assets/css/panel/notifications.css');
</style>
