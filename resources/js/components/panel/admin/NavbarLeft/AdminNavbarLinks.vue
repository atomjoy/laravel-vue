<script setup>
import NavbarLink from '@/components/panel/admin/NavbarLeft/NavbarLink.vue';
import IconAlbum from '@/assets/icons/IconAlbum.vue';
import IconContact from '@/assets/icons/IconContact.vue';
import IconRoles from '@/assets/icons/IconRoles.vue';
import IconSubscriber from '@/assets/icons/IconSubscriber.vue';
import IconUser from '@/assets/icons/IconUser.vue';
import IconWidget from '@/assets/icons/IconWidget.vue';
import { useAuthStore } from '@/stores/auth.js';

const auth = useAuthStore();
</script>

<template>
	<!-- Writer links -->
	<div v-if="auth.hasRole('super_admin', 'admin') || auth.hasRole('admin', 'admin') || auth.hasRole('writer', 'admin')">
		<NavbarLink to="/admin/dashboard" text="Dashboard">
			<IconWidget />
		</NavbarLink>

		<NavbarLink to="/admin/articlemedia" text="Images">
			<IconAlbum />
		</NavbarLink>
	</div>

	<!-- Admin links -->
	<div v-if="auth.hasRole('super_admin', 'admin') || auth.hasRole('admin', 'admin')">
		<NavbarLink to="/admin/contacts" text="Contacts">
			<IconContact />
		</NavbarLink>

		<NavbarLink to="/admin/subscribers" text="Subscribers">
			<IconSubscriber />
		</NavbarLink>
	</div>

	<!-- SuperAdmin links -->
	<div v-if="auth.hasRole('super_admin', 'admin')">
		<NavbarLink to="/admin/users" text="Users">
			<IconUser />
		</NavbarLink>

		<NavbarLink to="/admin/roles" text="Roles">
			<IconRoles />
		</NavbarLink>
	</div>
</template>
