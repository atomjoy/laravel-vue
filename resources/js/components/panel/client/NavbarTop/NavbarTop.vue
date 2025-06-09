<script setup>
import Notifications from '@/components/panel/client/notifications/Notifications.vue';
import OpenNavbar from '@/components/panel/client/navbarleft/OpenNavbar.vue';
import UserInfo from '@/components/panel/client/userinfo/UserInfo.vue';
import Title from './Title.vue';

const props = defineProps({
	title: { type: String, default: 'Dashboard' },
});
</script>

<template>
	<OpenNavbar />
	<Title :title="props.title" />
	<UserInfo />
	<Notifications />
</template>
