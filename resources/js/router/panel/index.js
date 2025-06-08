import adminRoutes from './admin';
import clientRoutes from './client';

// Panel routes
const routes = [...clientRoutes, ...adminRoutes];

export default routes;
