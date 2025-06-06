// Panel admin routes (guard web)
const routes = [
	// Redirect
	{
		path: '/admin',
		name: 'admin',
		redirect: { name: 'admin.dashboard' },
		meta: { requiresAuth: true, hasRole: ['super_admin', 'admin', 'writer'] },
	},
	// Dashboard
	{
		path: '/admin/dashboard',
		name: 'admin.dashboard',
		component: () => import('@/views/panel/admin/DefaultView.vue'),
		meta: { requiresAuth: true, hasRole: ['super_admin', 'admin', 'writer'] },
	},
	// // Roles
	// {
	// 	path: '/admin/roles',
	// 	name: 'admin.roles',
	// 	component: () => import('@/views/panel/admin/roles/RolesView.vue'),
	// 	meta: { requiresAuth: true, hasRole: ['super_admin'] },
	// },
	// // Users
	// {
	// 	path: '/admin/users',
	// 	name: 'admin.users',
	// 	component: () => import('@/views/panel/admin/users/UsersView.vue'),
	// 	meta: { requiresAuth: true, hasRole: ['super_admin', 'admin'] },
	// },
	// // Articles
	// {
	// 	path: '/admin/articles',
	// 	name: 'admin.articles',
	// 	component: () => import('@/views/panel/admin/articles/ArticlesView.vue'),
	// 	meta: { requiresAuth: true, hasRole: ['super_admin', 'admin', 'writer'] },
	// },
	// // Comments
	// {
	// 	path: '/admin/comments/edit',
	// 	name: 'admin.comments.edit',
	// 	redirect: { name: 'panel.comments' },
	// },
	// {
	// 	path: '/admin/comments',
	// 	name: 'admin.comments',
	// 	component: () => import('@/views/panel/admin/comments/ListView.vue'),
	// 	meta: { requiresAuth: true },
	// },
	// {
	// 	path: '/admin/comments/edit/:id',
	// 	name: 'admin.comments.edit.id',
	// 	component: () => import('@/views/panel/admin/comments/EditView.vue'),
	// 	meta: { requiresAuth: true },
	// },
];

export default routes;
