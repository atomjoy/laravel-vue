// Admin routes (guard admin)
const routes = [
	{
		path: '/admin/users/edit',
		name: 'admin.users.edit',
		redirect: { name: 'admin.users' },
	},
	{
		path: '/admin/users',
		name: 'admin.users',
		component: () => import('@/views/panel/admin/users/UserListView.vue'),
		meta: { requiresAdmin: true, hasRole: ['super_admin', 'admin'] },
	},
	{
		path: '/admin/users/create',
		name: 'admin.users.create',
		component: () => import('@/views/panel/admin/users/UserCreateView.vue'),
		meta: { requiresAdmin: true, hasRole: ['super_admin', 'admin'] },
	},
	{
		path: '/admin/users/edit/:id',
		name: 'admin.users.edit.id',
		component: () => import('@/views/panel/admin/users/UserEditView.vue'),
		meta: { requiresAdmin: true, hasRole: ['super_admin', 'admin'] },
	},
];

export default routes;
