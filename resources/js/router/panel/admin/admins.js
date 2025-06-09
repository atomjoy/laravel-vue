// Admin routes (guard admin)
const routes = [
	{
		path: '/admin/admins/edit',
		name: 'admin.admins.edit',
		redirect: { name: 'admin.admins' },
	},
	{
		path: '/admin/admins',
		name: 'admin.admins',
		component: () => import('@/views/panel/admin/admins/UserListView.vue'),
		meta: { requiresAdmin: true, hasRole: ['super_admin'] },
	},
	{
		path: '/admin/admins/create',
		name: 'admin.admins.create',
		component: () => import('@/views/panel/admin/admins/UserCreateView.vue'),
		meta: { requiresAdmin: true, hasRole: ['super_admin'] },
	},
	{
		path: '/admin/admins/edit/:id',
		name: 'admin.admins.edit.id',
		component: () => import('@/views/panel/admin/admins/UserEditView.vue'),
		meta: { requiresAdmin: true, hasRole: ['super_admin'] },
	},
];

export default routes;
