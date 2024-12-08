import PublicLayout from '../layout/public.vue';
import Login from '../pages/auth/login.vue';
import Register from '../pages/auth/register.vue';
const publicRoutes = [
    {
        path: '/',
        component: PublicLayout,
    },
    {
        path: '/login',
        component: Login,
    },
    {
        path: '/register',
        component: Register,
    }
];

export default publicRoutes;