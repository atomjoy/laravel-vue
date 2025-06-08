// Admin routes (guard admin)
const routes = [
	{
		path: '/admin/subscribers/edit',
		name: 'admin.subscribers.edit',
		redirect: { name: 'admin.subscribers' },
	},
	{
		path: '/admin/subscribers',
		name: 'admin.subscribers',
		component: () => import('@/views/panel/admin/subscribers/SubscriberListView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/subscribers/create',
		name: 'admin.subscribers.create',
		component: () => import('@/views/panel/admin/subscribers/SubscriberCreateView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/subscribers/edit/:id',
		name: 'admin.subscribers.edit.id',
		component: () => import('@/views/panel/admin/subscribers/SubscriberEditView.vue'),
		meta: { requiresAdmin: true },
	},
];

export default routes;
