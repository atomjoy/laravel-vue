import HomeView from '@/views/page/HomeView.vue';
import subscribe from './subscribe';
import docs from './docs';

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
	{
		path: '/contact',
		name: 'contact',
		component: () => import('@/views/page/ContactView.vue'),
	},
	{
		path: '/faqs',
		name: 'faqs',
		component: () => import('@/views/page/FaqsView.vue'),
	},
	...subscribe,
	...docs,
];

export default routes;
