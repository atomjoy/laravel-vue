import adminRoutes from './admin';
import clientRoutes from './client';
import settingsRoutes from './settings';

// Panel routes (guard web)
const routes = [...clientRoutes, ...settingsRoutes, ...adminRoutes];

export default routes;
