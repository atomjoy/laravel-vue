// Auth routes (guard admin)
const routes = [
	{
		path: '/admin/login',
		name: 'admin.login',
		component: () => import('@/views/auth/admin/LoginView.vue'),
		meta: { adminRoute: true },
	},
	{
		path: '/admin/logout',
		name: 'admin.logout',
		component: () => import('@/views/auth/admin/LogoutView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/password',
		name: 'admin.password',
		component: () => import('@/views/auth/admin/PasswordView.vue'),
	},
	{
		path: '/admin/login/f2a/:hash',
		name: 'admin.login.f2a',
		component: () => import('@/views/auth/admin/LoginF2aView.vue'),
	},
	// {
	// 	path: '/admin/register',
	// 	name: 'admin.register',
	// 	component: () => import('@/views/auth/admin/RegisterView.vue'),
	// },
	// {
	// 	path: '/admin/activate/:id/:code',
	// 	name: 'admin.activate',
	// 	component: () => import('@/views/auth/admin/ActivateView.vue'),
	// },
	// {
	// 	path: '/admin/change/email/:id/:code',
	// 	name: 'admin.change.email',
	// 	component: () => import('@/views/auth/admin/EmailChangeView.vue'),
	// 	meta: { requiresAuth: true },
	// },
];

export default routes;
