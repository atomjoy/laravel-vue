import HomeView from '@/views/page/HomeView.vue';

// Page routes
const routes = [
	// Redirect
	{
		path: '/homepage',
		name: 'homepage',
		redirect: { name: 'home' },
	},
	// Pages
	{
		path: '/',
		name: 'home',
		component: HomeView,
	},
	{
		path: '/about',
		name: 'about',
		component: () => import('@/views/page/AboutView.vue'),
	},
];

export default routes;
