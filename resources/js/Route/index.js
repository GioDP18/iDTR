import { createRouter, createWebHistory } from "vue-router";
import notFound from '../Components/404.vue';
import LoginView from '../Components/Views/LoginView.vue';
import RegisterView from '../Components/Views/RegisterView.vue';
import UserView from '../Components/Views/UserView.vue';
import UserDashboard from '../Components/Pages/User/Dashboard.vue';
import UserTimeLogAM from '../Components/Pages/User/TimeLogAM.vue';

const routes = [
    {
        path : '/',
        component : LoginView,
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
                path : '/timelog-am',
                component : UserTimeLogAM,
            },
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
