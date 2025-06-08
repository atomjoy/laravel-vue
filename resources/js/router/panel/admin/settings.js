// Admin routes (guard admin)
const routes = [
	// Redirect
	{
		path: '/admin/settings',
		name: 'admin.settings',
		redirect: { name: 'admin.settings.account' },
	},
	// Settings
	{
		path: '/admin/settings/account',
		name: 'admin.settings.account',
		component: () => import('@/views/panel/admin/settings/account/AccountView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/settings/details',
		name: 'admin.settings.details',
		component: () => import('@/views/panel/admin/settings/account/DetailsView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/settings/password',
		name: 'admin.settings.password',
		component: () => import('@/views/panel/admin/settings/account/PasswordView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/settings/delete',
		name: 'admin.settings.delete',
		component: () => import('@/views/panel/admin/settings/account/DeleteView.vue'),
		meta: { requiresAdmin: true },
	},
];

export default routes;
