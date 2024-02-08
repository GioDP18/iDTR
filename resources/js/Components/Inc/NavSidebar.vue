<script setup>
import { ref } from 'vue';

const showSidebar = ref(true);

const toggleSide = () => {
    showSidebar.value = !showSidebar.value;
};
</script>

<template>
    <div v-show="showSidebar">
        <div class="logo-header" data-background-color="blue">
            <a href="#" class="logo text-light">
                Supsofttech
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar" @click="toggleSide">
                    <i><font-awesome-icon :icon="['fas', 'bars']" /></i>
                </button>
            </div>
        </div>
        <div class="sidebar sidebar-style-2">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
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
                            <RouterLink to="/dashboard" class="collapsed" aria-expanded="false">
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
                                    <li :class="{ 'active': $route.path === '/timelogam' }">
                                        <RouterLink to="/timelogam">
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
