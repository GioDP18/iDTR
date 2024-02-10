<script setup>
import { ref, onMounted } from 'vue';

const timeLogExpanded = ref(false);
const showSidebar = ref(true);
const activeTime = ref("");

const toggleSidebar = () => {
    showSidebar.value = !showSidebar.value;
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
    updateActiveTime();
    setInterval(updateActiveTime, 1000);
});

</script>

<template>
    <div id="body-pd">
        <div class="main-header">
            <div class="logo-header" data-background-color="blue" v-show="showSidebar">
                <RouterLink to="/user/dashboard" class="logo text-light" style="font-weight: bold; font-size: 20px;">
                    SupSoftTech
                </RouterLink>
            </div>
            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
                <div class="navheadbar">
                    <button class="btn btn-toggle toggle-sidebar" @click="toggleSidebar">
                        <i><font-awesome-icon :icon="['fas', 'bars']" /></i>
                    </button>
                </div>
                <div class="container-fluid">
                    <div class="collapse" id="search-nav">
                        <div class="text-light">
                            <div class="text-light">
                                <h2 id="realTimeClock">{{ activeTime }}</h2>
                            </div>
                        </div>
                    </div>
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
        <div class="sidebar sidebar-style-2" :class="{ 'minimized': !showSidebar }">
            <div class="sidebar-wrapper scrollbar scrollbar-inner"
                :style="{ overflow: timeLogExpanded ? 'hidden' : 'auto' }">
                <div class="user" v-show="showSidebar || !showSidebar">
                    <div class="avatar-sm float-left mr-2">
                        <img :src="'../storage/images/profile.jpg'" alt="..." class="avatar-img rounded-circle">
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <span>
                                <span v-if="showSidebar">Gio O. Dela Pena</span>
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
</style>
