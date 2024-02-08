<script setup>
import { ref } from 'vue';

const timeLogExpanded = ref(false);
const showSidebar = ref(true);

function toggleSidebar() {
    showSidebar.value = !showSidebar.value;
}

const toggleTimeLog = () => {
    timeLogExpanded.value = !timeLogExpanded.value;
};

</script>

<template>
    <div id="body-pd">
        <div class="main-header">
            <div class="logo-header" data-background-color="blue" v-show="showSidebar">
                <a href="#" class="logo text-light">
                    Supsofttech
                </a>
            </div>
            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar" @click="toggleSidebar">
                        <i><font-awesome-icon :icon="['fas', 'bars']" /></i>
                    </button>
                </div>
                <div class="container-fluid">
                    <div class="collapse" id="search-nav">
                        <div class="text-light">
                            <h2 id="realTimeClock"></h2>
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
                                                    Gio O. Dela Pena
                                                </h4>
                                                <p class="text-muted">
                                                    giolagariza@gmail.com
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
        <div class="sidebar sidebar-style-2" v-show="showSidebar">
            <div class="sidebar-wrapper scrollbar scrollbar-inner"
                :style="{ overflow: timeLogExpanded ? 'hidden' : 'auto' }">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            <img :src="'../storage/images/profile.jpg'" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span>
                                    Gio O. Dela Pena
                                    <span class="user-level">Intern</span>
                                </span>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <ul class="nav nav-primary">
                        <li class="nav-item" :class="{ 'active': $route.path === '/dashboard' }">
                            <RouterLink to="/user/dashboard" class="collapsed" aria-expanded="false">
                                <i><font-awesome-icon :icon="['fas', 'chart-line']" /></i>
                                <p> Dashboard</p>
                            </RouterLink>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Monitoring</h4>
                        </li>
                        <li class="nav-item" :class="{ 'active': $route.path.startsWith('/timelog') }">
                            <a href="#" data-toggle="collapse" @click="toggleTimeLog" :aria-expanded="timeLogExpanded">
                                <i><font-awesome-icon :icon="['fas', 'clock']" /></i>
                                <p>Time Log</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" :class="{ 'show': timeLogExpanded }" id="timeLog">
                                <ul class="nav nav-collapse">
                                    <li :class="{ 'active': $route.path === '/user/timelog-am' }">
                                        <RouterLink to="/user/timelog-am">
                                            <span class="sub-item">AM</span>
                                        </RouterLink>
                                    </li>
                                    <li :class="{ 'active': $route.path === '/timelogpm' }">
                                        <RouterLink to="/timelogpm">
                                            <span class="sub-item">PM</span>
                                        </RouterLink>
                                    </li>
                                    <li :class="{ 'active': $route.path === '/overtime' }">
                                        <RouterLink to="/overtime">
                                            <span class="sub-item">Overtime</span>
                                        </RouterLink>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item" :class="{ 'active': $route.path === '/reports' }">
                            <RouterLink to="/reports">
                                <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                <p>Reports</p>
                            </RouterLink>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>

