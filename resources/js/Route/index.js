import { createRouter, createWebHistory } from "vue-router";
import notFound from '../Components/404.vue';
import LoginView from '../Components/Views/LoginView.vue';
import RegisterView from '../Components/Views/RegisterView.vue';
import UserView from '../Components/Views/UserView.vue';
import UserDashboard from '../Components/Pages/User/Dashboard.vue';
import UserTimeLogAM from '../Components/Pages/User/TimeLogAM.vue';
import UserTimeLogPM from '../Components/Pages/User/TimeLogPM.vue';
import BreakTime from '../Components/Pages/User/BreakTime.vue';
import Reports from '../Components/Pages/User/reports.vue';

const routes = [
    {
        path : '/',
        component : LoginView,
    },
    {
        path: '/register',
        component: RegisterView,
    },
    

    {
        path : '/user',
        component : UserView,
        children: [
            {
                path : 'dashboard',
                component : UserDashboard,
            },
            {
                path : 'timeLog-am',
                component : UserTimeLogAM,
            },
            {
                path : 'timeLog-pm',
                component : UserTimeLogPM,
            },
            {
                path : 'timeLogBreak',
                component : BreakTime,
            },
            {
                path : 'reports',
                component : Reports,
            }
        ]
    },
        
    {
        path : '/:pathMatch(.*)*',
        component : notFound
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router
