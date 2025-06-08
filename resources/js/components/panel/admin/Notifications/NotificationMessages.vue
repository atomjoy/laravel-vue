<script setup>
import IconRemove from '@/assets/icons/IconNotificationRemove.vue';
import NotificationAvatar from './NotificationAvatar.vue';
import { useNotifyStore } from '@/stores/notifications/user.js';

const store = useNotifyStore();

async function toggleNotify(id) {
	await store.toggleNotification(id);
	document.querySelector('#item_' + id)?.classList.toggle('notify_item_read');
}

function deleteNotify(id) {
	store.deleteNotification(id);
	document.querySelector('#item_' + id).remove();
}
</script>

<template>
	<div class="notify_empty_list" v-if="store.items.size == 0">
		{{ $t('List is empty.') }}
	</div>

	<div v-for="item of store.items.values()" :key="item.id">
		<div
			:id="'item_' + item.id"
			:class="{
				notify_item: true,
				notify_item_read: item.read_at != null,
			}"
		>
			<div class="notify_bar" @click="toggleNotify(item.id)">
				<div class="notify_item_dot"></div>

				<IconRemove
					class="notify_del_icon"
					@click.prevent="deleteNotify(item.id)"
				/>
			</div>

			<div class="notify_owner">
				<div class="notify_owner_avatar">
					<NotificationAvatar :image="item.data.sender_image" />
				</div>
				<div class="notify_owner_author">
					<div class="notify_owner_name">
						{{ item.data.sender_name ?? $t('Office Bot') }}
					</div>
					<div class="notify_owner_date">
						{{ item.formatted_created_at }}
					</div>
				</div>
			</div>
			<div class="notify_message">
				<div class="notify_title">{{ item.data.title }}</div>
				<div class="notify_text">{{ item.data.message }}</div>
				<div class="notify_links" v-if="item.data.links.length > 0">
					<a
						v-for="link of item.data.links"
						:href="link.url"
						:title="link.text"
						class="notify_link"
						:class="link.class"
						target="_blank"
					>
						{{ link.text }}
					</a>
				</div>
			</div>
		</div>
	</div>
</template>
