<script setup>
import store from '../../State/index.js'
import axios from 'axios';
import { ref } from 'vue';
import { Field, Form, ErrorMessage } from 'vee-validate';
import { useRouter } from 'vue-router';

const router = useRouter();

const showPassword = ref(false);
const username = ref('');
const password = ref('');

function togglePassword() {
    showPassword.value = !showPassword.value;
}


const login = async () => {
    store.commit('setLoading', true)
    try {
        await axios.post('/api/auth/login', {
            username: username.value,
            password: password.value,
        })
        .then((response) => {
            console.log(response);
            console.log('MY TOKEN: ' + response.data.access_token);
            localStorage.setItem('token', response.data.access_token);
            localStorage.setItem('valid', true);
            localStorage.setItem('userID', response.data.user.id);
            router.push('/user/dashboard');
        })
        .finally(() => {
            store.commit('setLoading', false)
        })

    } catch (error) {
        console.error('Error during registration:', error);
        store.commit('setLoginError', "Invaid credentials. Please try again.")
    }
}
</script>

<template>
    <div class="main-container">
        <div class="text-content">
            <div class="logo-transparent">
                <img src="../../../../public/images/logo-transparent.png" alt="">
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
                    <div class="separator">
                        <div class="line"></div>
                        <p>or</p>
                        <div class="line"></div>
                    </div>
                    <small v-if="store.state.loginError" style="color:red"><i class="fa-solid fa-circle-exclamation"></i> Invalid Credentials. Please try again.</small>
                    <div class="input-container">
                        <Field type="text" name="username" v-model="username" :rules="requiredUsername" placeholder="Enter Username" />
                        <span>
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <ErrorMessage class="error-message" name="username" />
                    <div class="input-container">
                        <Field v-model="password" name="password" :rules="requiredPassword" :type="showPassword ? 'text' : 'password'"
                            placeholder="Enter Password" />
                        <span id="password" @click="togglePassword">
                            <i :class="['fa-solid', showPassword ? 'fa-eye-slash' : 'fa-eye']"></i>
                        </span>
                    </div>
                    <ErrorMessage class="error-message" name="password" />
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
