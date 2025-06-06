// Panel routes (guard web)
const routes = [
	// Redirect
	{
		path: '/panel',
		name: 'panel',
		redirect: { name: 'panel.dashboard' },
	},
	// Dashboard
	{
		path: '/panel/dashboard',
		name: 'panel.dashboard',
		component: () => import('@/views/panel/client/DefaultView.vue'),
		meta: { requiresAuth: true },
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
