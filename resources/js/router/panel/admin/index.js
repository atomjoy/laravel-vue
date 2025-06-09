import users from './users.js';
import admins from './admins.js';
import contacts from './contacts.js';
import settings from './settings.js';
import subscribers from './subscribers.js';
import articlemedia from './articlemedia.js';

// Panel admin routes (guard admin)
const routes = [
	...settings,
	...contacts,
	...articlemedia,
	...subscribers,
	...users,
	...admins,
	// Redirect
	{
		path: '/admin',
		name: 'admin',
		redirect: { name: 'admin.dashboard' },
	},
	{
		path: '/admin/panel',
		name: 'admin.panel',
		redirect: { name: 'admin.dashboard' },
	},
	// Dashboard
	{
		path: '/admin/dashboard',
		name: 'admin.dashboard',
		component: () => import('@/views/panel/admin/DashboardView.vue'),
		meta: { requiresAdmin: true, hasRole: ['super_admin', 'admin', 'writer'] },
	},
	// Roles
	{
		path: '/admin/roles',
		name: 'admin.roles',
		component: () => import('@/views/panel/admin/roles/RolesView.vue'),
		meta: { requiresAdmin: true, hasRole: ['super_admin'] },
	},
];

export default routes;
