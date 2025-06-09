import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '@/stores/auth.js';
import authRoutes from './auth';
import pageRoutes from './page';
import panelRoutes from './panel';

const router = createRouter({
	linkActiveClass: 'router-link-active',
	linkExactActiveClass: 'router-link-exact-active',
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

	// Admin login
	if (to.meta.adminRoute) {
		// ✅ Login with remember me token and/or check is user authenticated
		await auth.isAuthenticatedAdmin();
		// ✅ Redirect to admin panel if logged
		if (to.name == 'admin.login' && auth.isLoggedIn.value) {
			next({ name: 'admin.panel' });
			return false;
		}
	}

	if (to.meta.requiresAdmin) {
		// Admin or User
		// ✅ Login with remember me token and/or check is user authenticated
		await auth.isAuthenticatedAdmin();
		// ✅ Redirect to admin panel if logged
		if (to.name == 'admin.login' && auth.isLoggedIn.value) {
			// Panel route name here: panel or client.panel
			next({ name: 'admin.panel' });
		} else if (to.meta.requiresAdmin && !auth.isLoggedIn.value) {
			// ✅ Redirect to login if not logged
			next({
				name: 'admin.login',
				query: { redirected_from: to.fullPath },
			});
		} else {
			// ✅ If roles required
			if (to.meta.hasRole) {
				// ✅ Check allowed roles
				for (let i = 0; i < to.meta.hasRole.length; i++) {
					const role = to.meta.hasRole[i];
					// ✅ Allow if has role
					if (auth.hasRole(role, 'admin')) {
						// ✅ Continue
						next();
						return false;
					}
				}
				// ✅ Has't role redirect
				next({ name: 'admin.panel' });
				return false;
			}
			// ✅ Continue
			next();
		}
	} else {
		// ✅ Login with remember me token and/or check is user authenticated
		await auth.isAuthenticated();
		// ✅ Redirect to panel if logged
		if (to.name == 'login' && auth.isLoggedIn.value) {
			// Panel route name here: panel or client.panel
			next({ name: 'panel' });
		} else if (to.meta.requiresAuth && !auth.isLoggedIn.value) {
			// ✅ Redirect to login if not logged
			next({
				name: 'login',
				query: { redirected_from: to.fullPath },
			});
		} else {
			// ✅ Continue
			next();
		}
	}
});

export default router;
