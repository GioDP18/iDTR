<script setup>

</script>

<template>
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
                    <li class="nav-item active" active-class="active">
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
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#timeLog" class="collapsed" aria-expanded="false">
                            <i><font-awesome-icon :icon="['fas', 'clock']" /></i>
                            <p>Time Log</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapses" id="timeLog">
                            <ul class="nav nav-collapse">
                                <li active-class="active">
                                    <a href="timeLog_am.php">
                                        <span class="sub-item">AM</span>
                                    </a>
                                </li>
                                <li active-class="active">
                                    <a href="timeLog_pm.php">
                                        <span class="sub-item">PM</span>
                                    </a>
                                </li>
                                <li active-class="active">
                                    <a href="overtime.php">
                                        <span class="sub-item">Overtime</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item" active-class="active">
                        <a href="reports.php">
                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                            <p>Reports</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>