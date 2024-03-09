<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import axios from 'axios';
import store from '../../State/index.js';
import { useRouter } from 'vue-router';

const router = useRouter();
const avatar = ref('');
const timeLogExpanded = ref(false);
const showSidebar = ref(true);
const showMobileSidebar = ref(false);
const activeTime = ref("");
const screenWidth = ref(window.innerWidth);
const userID = localStorage.getItem("userID");
const userObjects = ref([]);

const updateScreenWidth = () => {
    screenWidth.value = window.innerWidth;
};

const toggleSidebar = () => {
    showSidebar.value = !showSidebar.value;
};

const toggleMobileSidebar = () => {
    showMobileSidebar.value = !showMobileSidebar.value;
};

const toggleTimeLog = () => {
    timeLogExpanded.value = !timeLogExpanded.value;
};

const updateActiveTime = () => {
    const now = new Date();
    let hours = now.getHours();
    const minutes = now.getMinutes().toString().padStart(2, "0");
    const meridiem = hours >= 12 ? "PM" : "AM";
    hours = hours % 12 || 12;
    activeTime.value = `${hours}:${minutes} ${meridiem}`;
};

onMounted(() => {
    user();
    updateActiveTime();
    setInterval(updateActiveTime, 1000);
    window.addEventListener('resize', updateScreenWidth);
});
onBeforeUnmount(() => {
    window.removeEventListener('resize', updateScreenWidth);
});

const user = async () => {
    try {
        await axios.get(`/api/auth/user/${userID}`)
            .then((response) => {
                console.log(response.data);
                userObjects.value = response.data;
                avatar.value = response.data.user.avatar;
            })
            .finally(() => {
                store.commit('setLoading', false)
            })

    } catch (error) {
        console.error('Error during registration:', error);
    }
}

const handleLogout = async () => {
    try {
        const token = localStorage.getItem('token');
        const headers = { Authorization: `Bearer ${token}` };

        await axios.post('/api/auth/logout', {}, { headers })
            .then((response) => {
                if (response.data.success) {
                    localStorage.removeItem('token');
                    localStorage.setItem('valid', false);
                    router.push({ name: 'login' })
                }
                else {
                    swal({
                        icon: "error",
                        title: "Oops...",
                        text: response.data.message,
                    });
                }
            })
    }
    catch (error) {
        console.error('Error during logout:', error);
    }
}
</script>

<template>
    <div id="body-pd">
        <div class="main-header">
            <div class="logo-header" data-background-color="blue" v-show="showSidebar">
                <RouterLink to="/user/dashboard" class="logo text-light" style="font-weight: bold; font-size: 20px;">
                    <img style="height: 35px;  margin-right: 0px;" src="../../../../public/images/logo-transparent.png"
                        alt="">
                    iDTR System
                </RouterLink>
                <button class="navbar-toggler" type="button" @click="toggleMobileSidebar">
                    <span class="navbar-toggler-icon">
                        <i><font-awesome-icon :icon="['fas', 'bars']" /></i>
                    </span>
                </button>
                <div class="collapse navbar-collapse d-sm-none" :class="{ 'show': showMobileSidebar }" id="nav">
                    <ul class="navbar-nav bg-light m-0 ml-lg-auto p-3 p-lg-0">
                        <div v-for="user in userObjects" class="info">
                            <RouterLink to="updateProfile" aria-expanded="true">
                                <span style="display: flex; flex-direction: column; align-items: center;">
                                    <img :src="`../storage/${avatar}`" alt=".."
                                        class="avatar-img rounded-circle"
                                        style="width: 20px; height: 20px; margin: 8px;">
                                    <p class="text-secondary" style="font-size: 15px;">{{ user.firstname }}</p>
                                    <p class="user-level font-weight-bold text-secondary" style="font-size: 12px;">
                                        Intern</p>
                                </span>
                            </RouterLink>
                        </div>
                        <ul class="nav nav-primary">
                            <li :class="{ 'nav-item': true, 'active': $route.path === '/user/dashboard' }">
                                <RouterLink to="/user/dashboard" class="collapsed nav-link text-secondary"
                                    aria-expanded="false">
                                    <i><font-awesome-icon style="height:15px; margin-right: 8px;"
                                            :icon="['fas', 'chart-line']" /></i>
                                    <span v-if="showMobileSidebar" style="font-size: 15px;">Dashboard</span>
                                </RouterLink>
                            </li>
                            <li v-show="showMobileSidebar">
                                <h4 class="text-section" style="font-size: 14px; color: rgb(172, 167, 167);">Monitoring
                                </h4>
                            </li>
                            <li :class="{ 'nav-item': true, 'active': $route.path.startsWith('/user/timeLog') }">
                                <a class="text-secondary" href="#" @click="toggleTimeLog"
                                    :aria-expanded="timeLogExpanded">
                                    <i><font-awesome-icon style="height:15px; margin-right: 8px;"
                                            :icon="['fas', 'clock']" /></i>
                                    <span v-if="showMobileSidebar" style="font-size: 15px;">Time Log</span>
                                    <span class="caret" style="margin-left: 20px;"></span>
                                </a>
                                <div class="collapse" :class="{ 'show': timeLogExpanded }" id="timeLog">
                                    <ul class="nav nav-collapse" style="font-size: 15px;">
                                        <li :class="{ 'active': $route.path === '/user/timeLog-am' }">
                                            <RouterLink to="/user/timeLog-am">
                                                <span class="sub-item text-secondary">AM</span>
                                            </RouterLink>
                                        </li>
                                        <li :class="{ 'active': $route.path === '/user/timeLog-pm' }">
                                            <RouterLink to="/user/timeLog-pm">
                                                <span class="sub-item text-secondary">PM</span>
                                            </RouterLink>
                                        </li>
                                        <li :class="{ 'active': $route.path === '/user/timeLogBreak' }">
                                            <RouterLink to="/user/timeLogBreak">
                                                <span class="sub-item text-secondary">Break Time</span>
                                            </RouterLink>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li :class="{ 'nav-item': true, 'active': $route.path === '/user/reports' }">
                                <RouterLink to="/user/reports" class="collapsed nav-link text-secondary"
                                    aria-expanded="false">
                                    <i><font-awesome-icon style="height:15px; margin-right: 8px;"
                                            :icon="['fas', 'pen-to-square']" /></i>
                                    <span v-if="showMobileSidebar" style="font-size: 15px;">Reports</span>
                                </RouterLink>
                            </li>
                        </ul>
                    </ul>
                    <div class="fixed-bottom mb-3" style="width: 250px;">
                        <ul class="nav">
                            <li class="nav-item">
                                <button @click="handleLogout" class="nav-link" style="color: #af0000;">
                                    <i><font-awesome-icon style="height:15px; margin-right: 8px;"
                                            :icon="['fas', 'power-off']" /></i>
                                    <span v-if="showMobileSidebar" style="font-size: 15px;">Logout</span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-header navbar-expand-lg" v-show="screenWidth > 992" data-background-color="blue2">
                <div class="navheadbar">
                    <button class="btn btn-toggle toggle-sidebar" @click="toggleSidebar">
                        <i><font-awesome-icon :icon="['fas', 'bars']" /></i>
                    </button>
                </div>
            </nav>
        </div>
        <div v-for="user in userObjects" class="sidebar sidebar-style-2" :class="{ 'minimized': !showSidebar }">
            <div class="sidebar-wrapper scrollbar scrollbar-inner"
                :style="{ overflow: timeLogExpanded ? 'hidden' : 'auto' }">
                <div class="user" v-show="showSidebar || !showSidebar">
                    <div class="avatar-sm float-left mr-2">
                        <img :src="`../storage/${avatar}`" alt="..." class="avatar-img rounded-circle">
                    </div>
                    <div class="info">
                        <RouterLink to="updateProfile" aria-expanded="true">
                            <span>
                                <span v-if="showSidebar">{{ user.firstname }}</span>
                                <span class="user-level">Intern</span>
                            </span>
                        </RouterLink>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <ul class="nav nav-primary">
                    <li class="nav-item" :class="{ 'active': $route.path === '/user/dashboard' }">
                        <RouterLink to="/user/dashboard" class="collapsed" aria-expanded="false">
                            <i><font-awesome-icon :icon="['fas', 'chart-line']" /></i>
                            <p><span v-if="showSidebar">Dashboard</span></p>
                        </RouterLink>
                    </li>

                    <li class="nav-section" v-show="showSidebar">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Monitoring</h4>
                    </li>
                    <li class="nav-item" :class="{ 'active': $route.path.startsWith('/user/timeLog') }">
                        <a href="#" data-toggle="collapse" @click="toggleTimeLog" :aria-expanded="timeLogExpanded">
                            <i><font-awesome-icon :icon="['fas', 'clock']" /></i>
                            <p><span v-if="showSidebar">Time Log</span></p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" :class="{ 'show': timeLogExpanded }" id="timeLog">
                            <ul class="nav nav-collapse">
                                <li :class="{ 'active': $route.path === '/user/timeLog-am' }">
                                    <RouterLink to="/user/timeLog-am">
                                        <span class="sub-item">AM</span>
                                    </RouterLink>
                                </li>
                                <li :class="{ 'active': $route.path === '/user/timeLog-pm' }">
                                    <RouterLink to="/user/timeLog-pm">
                                        <span class="sub-item">PM</span>
                                    </RouterLink>
                                </li>
                                <li :class="{ 'active': $route.path === '/user/timeLogBreak' }">
                                    <RouterLink to="/user/timeLogBreak">
                                        <span class="sub-item">Break Time</span>
                                    </RouterLink>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item" :class="{ 'active': $route.path === '/user/reports' }">
                        <RouterLink to="/user/reports">
                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                            <p><span v-if="showSidebar">Reports</span></p>
                        </RouterLink>
                    </li>
                    <div class="fixed-bottom mb-3" style="width: 250px;">
                        <!-- Apply Bootstrap's fixed-bottom class and add margin -->
                        <ul class="nav">
                            <li class="nav-item">
                                <button @click="handleLogout" class="nav-link" style="color: #af0000;">
                                    <i><font-awesome-icon style="color: #af0000;" :icon="['fas', 'power-off']" /></i>
                                    <span>Logout</span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </ul>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <Router-view :class="{ 'sidebar-minimized': !showSidebar }">
        </Router-view>
    </div>
</template>

<style scoped>
.navheadbar {
    display: flex;
    align-items: center;
    padding: 0 15px;
}

.navheadbar .btn-toggle {
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 10px;
    margin-right: 10px;
}

.minimized {
    width: 80px;
}

.minimized .sidebar-wrapper {
    width: 80px;
}

.minimized .avatar-sm,
.minimized .nav-item RouterLink i {
    display: block;
}

.minimized .user {
    padding-bottom: 57px;
    margin-left: 5px;
}

.minimized .info,
.minimized .nav-item RouterLink p {
    display: none;
}

.minimized .nav-item .caret {
    display: none;
}

.minimized .nav-item i {
    margin-left: 5px;
}

.minimized .nav-collapse {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.minimized .collapse .nav li a {
    width: 55px;
}

.minimized .collapse .nav li span {
    width: 40px;
    margin-left: -5px;
    font-size: 12px;
}

.sidebar-minimized {
    width: calc(100% - 80px);
}

@media screen and (max-width: 360px) {
    .main-header {
        width: 100%;
    }

    .main-header .navbar .navheadbar {
        margin-right: 100px;
        padding-top: 100px;
    }
}

body {
    padding-top: 55px;
}

@media (max-width: 992px) {

    .navbar-collapse.collapsing .navbar-nav {
        display: block;
        position: fixed;
        top: 0;
        bottom: 0;
        left: -45%;
        transition: all 0.2s ease;
    }

    .navbar-collapse.show .navbar-nav {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        flex-direction: column;
        height: auto;
        width: 45%;
        transition: left 0.35s ease;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
}

.nav-collapse {
    flex-direction: column !important;
}

.user {
    display: flex;
    align-items: center;
}

.user .info {
    margin-left: 10px;
    /* Adjust the margin as needed */
}
</style>
