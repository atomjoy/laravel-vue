<script setup>
import IconEdit from '@/assets/icons/IconEdit.vue';
import IconUser from '@/assets/icons/IconUser.vue';
import IconReply from '@/assets/icons/IconReply.vue';
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

	<!-- Editor and Manager -->
	<div v-if="auth.hasRole('editor', 'web')">
		<NavbarLink to="/panel/comments" text="Comments">
			<IconReply />
		</NavbarLink>
	</div>

	<!-- Manager only -->
	<div v-if="auth.hasRole('manager', 'web')">
		<!-- <NavbarLink to="/panel/manager" text="Manager">
			<IconEdit />
		</NavbarLink> -->
	</div>

	<!-- Vip users only -->
	<div v-if="auth.hasRole('vip', 'web')">
		<!-- <NavbarLink to="/panel/vip" text="Vip">
			<IconEdit />
		</NavbarLink> -->
	</div>
</template>
