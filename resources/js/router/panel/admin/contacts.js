// Admin routes (guard admin)
const routes = [
	{
		path: '/admin/contacts/edit',
		name: 'admin.contacts.edit',
		redirect: { name: 'admin.contacts' },
	},
	{
		path: '/admin/contacts',
		name: 'admin.contacts',
		component: () => import('@/views/panel/admin/contacts/ContactListView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/contacts/edit/:id',
		name: 'admin.contacts.edit.id',
		component: () => import('@/views/panel/admin/contacts/ContactEditView.vue'),
		meta: { requiresAdmin: true },
	},
];

export default routes;
