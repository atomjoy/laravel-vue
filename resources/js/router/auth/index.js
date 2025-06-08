import adminRoutes from './admin';
import clientRoutes from './client';

// Auth routes (guard web)
const routes = [...clientRoutes, ...adminRoutes];

export default routes;
