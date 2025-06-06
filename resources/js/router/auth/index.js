// Auth routes (guard web)
const routes = [
	{
		path: '/login',
		name: 'login',
		component: () => import('@/views/auth/LoginView.vue'),
	},
	// {
	// 	path: '/register',
	// 	name: 'register',
	// 	component: () => import('@/views/auth/RegisterView.vue'),
	// },
	// {
	// 	path: '/password',
	// 	name: 'password',
	// 	component: () => import('@/views/auth/PasswordView.vue'),
	// },
	// {
	// 	path: '/login/f2a/:hash',
	// 	name: 'login.f2a',
	// 	component: () => import('@/views/auth/LoginF2aView.vue'),
	// },
	// {
	// 	path: '/activate/:id/:code',
	// 	name: 'activate',
	// 	component: () => import('@/views/auth/ActivateView.vue'),
	// },
	// {
	// 	path: '/change/email/:id/:code',
	// 	name: 'change.email',
	// 	component: () => import('@/views/auth/EmailChangeView.vue'),
	// 	meta: { requiresAuth: true },
	// },
	// {
	// 	path: '/logout',
	// 	name: 'logout',
	// 	component: () => import('@/views/auth/LogoutView.vue'),
	// 	meta: { requiresAuth: true },
	// },
];

export default routes;
