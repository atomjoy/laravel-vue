<script setup>
import Notifications from '@/components/panel/client/Notifications/Notifications.vue';
import OpenNavbar from '@/components/panel/client/NavbarLeft/OpenNavbar.vue';
import UserInfo from '@/components/panel/client/UserInfo/UserInfo.vue';
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
