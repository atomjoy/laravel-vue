// Admin routes (guard admin)
const routes = [
	{
		path: '/admin/articlemedia/edit',
		name: 'admin.articlemedia.edit',
		redirect: { name: 'admin.articlemedia' },
	},
	{
		path: '/admin/articlemedia',
		name: 'admin.articlemedia',
		component: () => import('@/views/panel/admin/articlemedia/ArticleMediaListView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/articlemedia/create',
		name: 'admin.articlemedia.create',
		component: () => import('@/views/panel/admin/articlemedia/ArticleMediaCreateView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/articlemedia/edit/:id',
		name: 'admin.articlemedia.edit.id',
		component: () => import('@/views/panel/admin/articlemedia/ArticleMediaEditView.vue'),
		meta: { requiresAdmin: true },
	},
];

export default routes;
