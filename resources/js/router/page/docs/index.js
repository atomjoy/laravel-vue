const routes = [
	{
		path: '/docs/policy',
		name: 'docs.policy',
		component: () => import('@/views/page/docs/PolicyView.vue'),
	},
	{
		path: '/docs/terms',
		name: 'docs.terms',
		component: () => import('@/views/page/docs/TermsView.vue'),
	},
];

export default routes;
