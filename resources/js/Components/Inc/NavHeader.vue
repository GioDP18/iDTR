<script setup>
import { ref, onMounted } from 'vue';

const activeTime = ref("");

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
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
        <div class="container-fluid">
            <div class="collapse" id="search-nav">
                <div class="text-light">
                    <h2 id="realTimeClock">{{ activeTime }}</h2>
                </div>
            </div>
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item toggle-nav-search hidden-caret">
                    <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false"
                        aria-controls="search-nav">
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
                                    <div class="avatar-lg"><img :src="'../storage/images/profile.jpg'" alt="image profile"
                                            class="avatar-img rounded"></div>
                                    <div class="u-text">
                                        <h4>
                                            Gio O. Dela Pena
                                        </h4>
                                        <p class="text-muted">
                                            giolagariza@gmail.com
                                        </p><a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
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
</template>

<style scoped>

</style>