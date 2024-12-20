import PublicLayout from '../layout/public.vue';
import Login from '../pages/auth/login.vue';
import Register from '../pages/auth/register.vue';
import Today from '../pages/user/Today/index.vue';
import NextWeek from '../pages/user/NextWeek/index.vue';
import AllTask from '../pages/user/AllTask/index.vue';
import Calendar from '../pages/user/Calendar/index.vue';
import List from '../pages/user/MyList/index.vue';
const publicRoutes = [
    {
        path: '/',
        component: PublicLayout,
        children: [
            {
                path: 'myday',
                component: Today,
            },
            {
                path: 'nextweek',
                component: NextWeek,
            },
            {
                path: 'alltask',
                component: AllTask,
            },
            {
                path: 'calendar',
                component: Calendar,
            },
            {
                path: 'task/lists',
                component: List,
            },
            // {
            //     path: '',
            //     redirect: '/myday',
            // },
        ]
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