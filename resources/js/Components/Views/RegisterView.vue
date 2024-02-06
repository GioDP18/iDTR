<script setup>
import { ref } from 'vue';

const showPassword = ref(false);
const showConfirmPassword = ref(false);

function togglePassword() {
    showPassword.value = !showPassword.value;
}
function toggleConfirmPassword() {
    showConfirmPassword.value = !showConfirmPassword.value;
}
</script>
<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-5 d-flex align-items-center justify-content-center"
                style="background-color: white; height: 100vh;">
                <div class="register-container">
                    <div class="register-form">
                        <form class="form" @submit.prevent="register" style="position:relative;">
                            <p class="form-title">Sign up to your account</p>
                            <div class="input-container">
                                <input v-model="firstname" type="text" placeholder="Enter Firstname">
                            </div>
                            <div class="input-container">
                                <input v-model="lastname" type="text" placeholder="Enter Lastname">
                            </div>
                            <div class="input-container">
                                <input v-model="username" type="text" placeholder="Enter Username">
                                <span>
                                    <i class="fa-solid fa-user"></i>
                                </span>
                            </div>
                            <div class="input-container">
                                <input v-model="email" type="email" placeholder="Enter Email">
                                <span>
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                            </div>
                            <div class="input-container">
                                <input v-model="password" :type="showPassword ? 'text' : 'password'"
                                    placeholder="Enter Password">
                                <span style="cursor:pointer;" @click="togglePassword">
                                    <i :class="['fa-solid', showPassword ? 'fa-eye-slash' : 'fa-eye']"></i>
                                </span>
                            </div>
                            <div class="input-container">
                                <input v-model="password_confirmation" :type="showConfirmPassword ? 'text' : 'password'"
                                    placeholder="Confirm Password">
                                <span style="cursor:pointer;" @click="toggleConfirmPassword">
                                    <i :class="['fa-solid', showConfirmPassword ? 'fa-eye-slash' : 'fa-eye']"></i>
                                </span>
                            </div>
                            <button class="submit" type="submit">
                                Sign up
                            </button>
                            <p class="signup-link">
                                Already have an account?
                                <RouterLink to="/">Sign in</RouterLink>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-7 d-flex align-items-center justify-content-center"
                style="background-color: #1269db; height: 100vh; padding:8em">
                <div class="logo-container align-items-center text-center">
                    <img src="../../../img/logo-transparent.png" alt="" style="width:12rem; height:10rem;">
                    <h5 class="text-light mt-4">Unlocking productivity, one clock-in at a time. iDTR: Where dedication meets
                        efficiency, shaping a seamless journey through time records and unlocking the door to professional
                        growth.</h5>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.register-container {
    display: flex;
    justify-content: start;
    box-shadow: 4px #000;
}

.register-form {
    background-color: white;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 1rem;
}

.form {
    background-color: #fff;
    display: block;
    padding: 1rem;
    max-width: 350px;
    border-radius: 0.5rem;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.form-title {
    font-size: 1.25rem;
    line-height: 1.75rem;
    font-weight: 600;
    text-align: center;
    color: #000;
}

.input-container {
    position: relative;
}

.input-container input,
.form button {
    outline: none;
    border: 1px solid #e5e7eb;
    margin: 8px 0;
}

.input-container input {
    background-color: #fff;
    padding: 1rem;
    padding-right: 3rem;
    font-size: 0.875rem;
    line-height: 1.25rem;
    width: 300px;
    border-radius: 0.5rem;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}

.input-container span {
    display: grid;
    position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    padding-left: 1rem;
    padding-right: 1rem;
    place-content: center;
}

.input-container span i {
    color: #9CA3AF;
    width: 1rem;
    height: 1rem;
}

.submit {
    display: block;
    padding-top: 0.75rem;
    padding-bottom: 0.75rem;
    padding-left: 1.25rem;
    padding-right: 1.25rem;
    background-color: #1269DB;
    color: #ffffff;
    font-size: 0.875rem;
    line-height: 1.25rem;
    font-weight: 500;
    width: 100%;
    border-radius: 0.5rem;
    text-transform: uppercase;
}

.signup-link {
    color: #6B7280;
    font-size: 0.875rem;
    line-height: 1.25rem;
    text-align: center;
}

.signup-link a {
    text-decoration: underline;
}
</style>