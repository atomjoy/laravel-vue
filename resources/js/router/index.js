import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '@/stores/auth';
import authRoutes from './auth';
import pageRoutes from './page';
import panelRoutes from './panel';

const router = createRouter({
	linkActiveClass: 'router_link_active',
	linkExactActiveClass: 'router_link_exact_active',
	history: createWebHistory('/'),
	routes: [
		...pageRoutes,
		...authRoutes,
		...panelRoutes,
		{
			path: '/:catchAll(.*)',
			name: 'error.page',
			component: () => import('@/views/errors/404.vue'),
		},
	],
	scrollBehavior(to, from, savedPosition) {
		return { top: 1, behavior: 'smooth' };
	},
});

router.beforeEach(async (to, from, next) => {
	// ✅ This will work make sure the correct store is used for the current running app
	const auth = useAuthStore();
	// ✅ Login with remember me token and/or check is user authenticated
	await auth.isAuthenticated();
	// ✅ Redirect to panel if logged
	if (to.name == 'login' && auth.isLoggedIn.value) {
		next({ name: 'panel' });
	} else if (to.meta.requiresAuth && !auth.isLoggedIn.value) {
		// ✅ Redirect to login if not logged
		next({ name: 'login', query: { redirected_from: to.fullPath } });
	} else {
		// ✅ Continue
		next();
	}
});

export default router;
