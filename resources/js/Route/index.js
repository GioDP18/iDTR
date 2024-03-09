import { createRouter, createWebHistory } from "vue-router";
import isAuthenticated from "../Middleware/isAuthenticated";
import notFound from "../Components/404.vue";
import LoginView from "../Components/Views/LoginView.vue";
import RegisterView from "../Components/Views/RegisterView.vue";
import UserView from "../Components/Views/UserView.vue";
import UserDashboard from "../Components/Pages/User/Dashboard.vue";
import UpdateProfile from "../Components/Pages/User/UpdateProfile.vue";
import UserTimeLogAM from "../Components/Pages/User/TimeLogAM.vue";
import UserTimeLogPM from "../Components/Pages/User/TimeLogPM.vue";
import BreakTime from "../Components/Pages/User/BreakTime.vue";
import Reports from "../Components/Pages/User/Reports.vue";

const routes = [
    {
        path: "/",
        component: LoginView,
        name: "login",
    },
    {
        path: "/register",
        component: RegisterView,
    },
    {
        path: "/user",
        component: UserView,
        meta: { requiresAuth: true },
        children: [
            {
                path: "dashboard",
                component: UserDashboard,
            },
            {
                path: "updateProfile",
                component: UpdateProfile,
            },
            {
                path: "timeLog-am",
                component: UserTimeLogAM,
            },
            {
                path: "timeLog-pm",
                component: UserTimeLogPM,
            },
            {
                path: "timeLogBreak",
                component: BreakTime,
            },
            {
                path: "reports",
                component: Reports,
            },
        ],
    },

    {
        path: "/:pathMatch(.*)*",
        component: notFound,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, from, next) => {
    if (to.meta.requiresAuth) {
        const authenticated = await isAuthenticated();

        if (!authenticated) {
            console.log("Unauthorized");
            next({ name: "login" });
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
