<script setup>
import IconAdmin from '@/assets/icons/IconAdmin.vue';
import IconReply from '@/assets/icons/IconReply.vue';
import IconUser from '@/assets/icons/IconUser.vue';
import IconWidget from '@/assets/icons/IconWidget.vue';
import NavbarLink from '@/components/panel/client/navbarleft/NavbarLink.vue';
import { useAuthStore } from '@/stores/auth.js';

const auth = useAuthStore();
</script>

<template>
	<!-- Client links -->
	<NavbarLink to="/panel/dashboard" text="Dashboard">
		<IconWidget />
	</NavbarLink>

	<!-- <NavbarLink to="/panel/comments" text="Comments">
		<IconReply />
	</NavbarLink> -->
</template>
