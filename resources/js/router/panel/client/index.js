import settingsRoutes from './settings.js';

// Panel routes (guard web)
const routes = [
	...settingsRoutes,
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
	// Editor
	{
		path: '/panel/editor',
		name: 'panel.editor',
		component: () => import('@/views/panel/client/EditorView.vue'),
		meta: { requiresAuth: true, hasRole: ['editor', 'manager'] },
	},
	// Comments
	// {
	// 	path: '/panel/comments/edit',
	// 	name: 'panel.comments.edit',
	// 	redirect: { name: 'panel.comments' },
	// },
	// {
	// 	path: '/panel/comments',
	// 	name: 'panel.comments',
	// 	component: () => import('@/views/panel/client/comments/ListView.vue'),
	// 	meta: { requiresAuth: true },
	// },
	// {
	// 	path: '/panel/comments/edit/:id',
	// 	name: 'panel.comments.edit.id',
	// 	component: () => import('@/views/panel/client/comments/EditView.vue'),
	// 	meta: { requiresAuth: true },
	// },
];

export default routes;
