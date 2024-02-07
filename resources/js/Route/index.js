import { createRouter, createWebHistory } from "vue-router";
import notFound from '../Components/404.vue';
import LoginView from '../Components/Views/LoginView.vue';
import UserView from '../Components/Views/UserView.vue';
import UserDashboard from '../Components/Pages/User/Dashboard.vue';


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
