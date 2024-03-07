<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import axios from 'axios';
import store from '../../State/index.js';

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
    })
    .finally(() => {
        store.commit('setLoading', false)
    })

  } catch (error) {
    console.error('Error during registration:', error);
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
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span style="display: flex; flex-direction: column; align-items: center;">
                                    <img :src="'../storage/images/profile.jpg'" alt=".." class="avatar-img rounded-circle"
                                        style="width: 20px; height: 20px; margin: 8px;">
                                    <p class="text-secondary" style="font-size: 15px;">{{ user.firstname }}</p>
                                    <p class="user-level font-weight-bold text-secondary" style="font-size: 12px;">
                                        Intern</p>
                                </span>
                            </a>
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
                                <h4 class="text-section" style="font-size: 14px; color: rgb(172, 167, 167);">Monitoring</h4>
                            </li>
                            <li :class="{ 'nav-item': true, 'active': $route.path.startsWith('/user/timeLog') }">
                                <a class="text-secondary" href="#" @click="toggleTimeLog" :aria-expanded="timeLogExpanded">
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
                </div>
            </div>
            <nav class="navbar navbar-header navbar-expand-lg" v-show="screenWidth > 992" data-background-color="blue2">
                <div class="navheadbar">
                    <button class="btn btn-toggle toggle-sidebar" @click="toggleSidebar">
                        <i><font-awesome-icon :icon="['fas', 'bars']" /></i>
                    </button>
                </div>
                <div class="container-fluid">
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item toggle-nav-search hidden-caret">
                            <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button"
                                aria-expanded="false" aria-controls="search-nav">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                                <div class="avatar-sm">
                                    <img :src="'../storage/images/profile.jpg'" alt="..." class="avatar-img rounded-circle">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg"><img :src="'../storage/images/profile.jpg'"
                                                    alt="image profile" class="avatar-img rounded"></div>
                                            <div class="u-text">
                                                <h4>
                                                    <span v-if="showSidebar">Gio O. Dela Pena</span>
                                                </h4>
                                                <p class="text-muted">
                                                    <span v-if="showSidebar">giolagariza@gmail.com</span>
                                                </p><a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View
                                                    Profile</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Account Setting</a>
                                        <div class="dropdown-divider"></div>
                                        <form action="../backend/authentication.php" method="POST">
                                            <button type="submit" name="logout" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div v-for="user in userObjects" class="sidebar sidebar-style-2" :class="{ 'minimized': !showSidebar }">
            <div class="sidebar-wrapper scrollbar scrollbar-inner"
                :style="{ overflow: timeLogExpanded ? 'hidden' : 'auto' }">
                <div class="user" v-show="showSidebar || !showSidebar">
                    <div class="avatar-sm float-left mr-2">
                        <img :src="'../storage/images/profile.jpg'" alt="..." class="avatar-img rounded-circle">
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <span>
                                <span v-if="showSidebar">{{ user.firstname }}</span>
                                <span class="user-level">Intern</span>
                            </span>
                        </a>
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
