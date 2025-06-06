// Panel routes (guard web)
const routes = [
	// Redirect
	{
		path: '/panel/settings',
		name: 'panel.settings',
		redirect: { name: 'panel.settings.account' },
	},
	// Settings
	{
		path: '/panel/settings/account',
		name: 'panel.settings.account',
		component: () => import('@/views/panel/settings/Account/AccountView.vue'),
		meta: { requiresAuth: true },
	},
	// {
	// 	path: '/panel/settings/details',
	// 	name: 'panel.settings.details',
	// 	component: () => import('@/views/panel/settings/Account/DetailsView.vue'),
	// 	meta: { requiresAuth: true },
	// },
	// {
	// 	path: '/panel/settings/delete',
	// 	name: 'panel.settings.delete',
	// 	component: () => import('@/views/panel/settings/Account/DeleteView.vue'),
	// 	meta: { requiresAuth: true },
	// },
	// {
	// 	path: '/panel/settings/password',
	// 	name: 'panel.settings.password',
	// 	component: () => import('@/views/panel/settings/Account/PasswordView.vue'),
	// 	meta: { requiresAuth: true },
	// },
];

export default routes;
