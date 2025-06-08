const routes = [
	// Subscribe
	{
		path: '/subscribe',
		name: 'subscribe',
		component: () => import('@/views/page/subscribe/SubscribeView.vue'),
	},
	{
		path: '/subscribe/confirm/:id',
		name: 'subscribe.confirm',
		component: () => import('@/views/page/subscribe/SubscribeConfirmView.vue'),
	},
	{
		path: '/unsubscribe',
		name: 'unsubscribe',
		component: () => import('@/views/page/subscribe/UnsubscribeView.vue'),
	},
	{
		path: '/unsubscribe/:email',
		name: 'unsubscribe.email',
		component: () => import('@/views/page/subscribe/SubscribeRemoveView.vue'),
	},
];

export default routes;
