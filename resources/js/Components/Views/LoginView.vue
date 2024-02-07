<script setup>
import { ref } from 'vue';

const showPassword = ref(false);

function togglePassword() {
    showPassword.value = !showPassword.value;
}

function login() {
    //Login function
}

</script>

<template>
    <div class="main-container">
        <div class="content">
            <div class="logo-transparent">
                <img src="../../../../public/storage/logo/logo-transparent.png" alt="">
            </div>
            <div class="text-center mt-4">
                <h5 class="text-light">Unlocking productivity, one clock-in at a time. iDTR:
                    Where dedication meets efficiency, shaping a seamless journey through time records
                    and unlocking the door to professional growth.</h5>
            </div>
        </div>
        <div class="login-container">
            <div class="login-form">
                <form class="form" @submit.prevent="login" method="POST">
                    <p class="form-title">Sign in to your account</p>
                    <div class="social-icons">
                        <RouterLink to="/"><i class="fa-brands fa-google-plus-g"></i></RouterLink>
                        <RouterLink to="/"><i class="fa-brands fa-github"></i></RouterLink>
                    </div>
                    <div class="seperator">
                        <div class="line"></div>
                        <p>or</p>
                        <div class="line"></div>
                    </div>
                    <div class="input-container">
                        <input type="text" name="username" placeholder="Enter Username" required>
                        <span>
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <div class="input-container">
                        <input name="password" v-model="password" :type="showPassword ? 'text' : 'password'"
                            placeholder="Enter Password" required>
                        <span id="password" @click="togglePassword">
                            <i :class="['fa-solid', showPassword ? 'fa-eye-slash' : 'fa-eye']"></i>
                        </span>
                    </div>
                    <button class="submit" type="submit" name="login">
                        Sign in
                    </button>
                    <RouterLink to="/" class="forgot-pass">Forgot Password?</RouterLink>
                    <p class="signup-link">
                        No account?
                        <RouterLink to="/register">Sign up</RouterLink>
                    </p>
                </form>
            </div>
        </div>
    </div>
</template>
  
<style scoped></style>