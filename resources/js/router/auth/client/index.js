// Auth routes (guard web)
const routes = [
	{
		path: '/login',
		name: 'login',
		component: () => import('@/views/auth/client/LoginView.vue'),
	},
	{
		path: '/logout',
		name: 'logout',
		component: () => import('@/views/auth/client/LogoutView.vue'),
		meta: { requiresAuth: true },
	},
	{
		path: '/register',
		name: 'register',
		component: () => import('@/views/auth/client/RegisterView.vue'),
	},
	{
		path: '/password',
		name: 'password',
		component: () => import('@/views/auth/client/PasswordView.vue'),
	},
	{
		path: '/login/f2a/:hash',
		name: 'login.f2a',
		component: () => import('@/views/auth/client/LoginF2aView.vue'),
	},
	{
		path: '/activate/:id/:code',
		name: 'activate',
		component: () => import('@/views/auth/client/ActivateView.vue'),
	},
	{
		path: '/change/email/:id/:code',
		name: 'change.email',
		component: () => import('@/views/auth/client/EmailChangeView.vue'),
		meta: { requiresAuth: true },
	},
];

export default routes;
