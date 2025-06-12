// Client routes (guard web)
const routes = [
	{
		path: '/panel/vip',
		name: 'panel.vip',
		component: () => import('@/views/panel/client/vip/VipView.vue'),
		meta: { requiresAuth: true, hasRole: ['vip'] },
	},
];

export default routes;
