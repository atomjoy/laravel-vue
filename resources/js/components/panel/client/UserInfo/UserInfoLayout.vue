<script setup>
import { ref } from 'vue';
import { useAuthStore } from '@/stores/auth.js';
import UserDetails from './UserDetails.vue';
import UserButton from './UserButton.vue';

// Replace with authStore user details
const auth = useAuthStore();
let user = auth.getUser;

// const props = defineProps({
// 	name: { default: 'Unknown' },
// 	email: { default: 'unknown@example.com' },
// 	image: { default: '/default/avatar.webp' },
// });

let open = ref(false);

function toggle() {
	open.value = !open.value;
}
</script>

<template>
	<div class="user_info_layout">
		<div class="user_info_layout_top" @click="toggle">
			<slot name="avatar">
				<UserButton :open="open" :image="user.avatar" />
			</slot>
		</div>

		<div class="user_info_layout_menu" v-if="open">
			<slot name="info">
				<UserDetails :name="user.name" :email="user.email" :image="user.avatar" />
			</slot>

			<div class="user_info_layout_links">
				<slot>
					<!-- Only Link Example -->

					<!--
					<RouterLink to="/logout" class="user_info_layout_link">
						<IconLogout />
						<span>{{ $t('Logout') }}</span>
					</RouterLink> -->
				</slot>
			</div>
		</div>
	</div>
</template>

<style>
@import url('@/assets/css/panel/panel.css');
</style>
