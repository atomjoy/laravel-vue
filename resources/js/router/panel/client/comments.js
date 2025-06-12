// Client routes (guard web)
const routes = [
	{
		path: '/panel/comments/edit',
		name: 'panel.comments.edit',
		redirect: { name: 'panel.comments' },
	},
	{
		path: '/panel/comments',
		name: 'panel.comments',
		component: () => import('@/views/panel/client/comments/ListView.vue'),
		meta: { requiresAuth: true, hasRole: ['editor'] },
	},
	{
		path: '/panel/comments/edit/:id',
		name: 'panel.comments.edit.id',
		component: () => import('@/views/panel/client/comments/EditView.vue'),
		meta: { requiresAuth: true, hasRole: ['editor'] },
	},
];

export default routes;
