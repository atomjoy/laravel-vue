import settingsRoutes from './settings.js';
import commentsRoutes from './comments.js';
import vipRoutes from './vip.js';

// Panel routes (guard web)
const routes = [
	// Redirect
	{
		path: '/panel',
		name: 'panel',
		redirect: { name: 'panel.dashboard' },
	},
	{
		path: '/client/panel',
		name: 'client.panel',
		redirect: { name: 'panel.dashboard' },
	},
	// Dashboard
	{
		path: '/panel/dashboard',
		name: 'panel.dashboard',
		component: () => import('@/views/panel/client/DashboardView.vue'),
		meta: { requiresAuth: true },
	},
	...settingsRoutes,
	...commentsRoutes,
	...vipRoutes,
];

export default routes;
