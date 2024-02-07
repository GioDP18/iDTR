<script setup>
import { ref } from 'vue';
import { Field, Form, ErrorMessage } from 'vee-validate';

const showPassword = ref(false);

function togglePassword() {
    showPassword.value = !showPassword.value;
}

function login() {
    //Login function
}

function requiredUsername(value) {
  if (value && value.trim()) {
    return true;
  }
  return 'Please enter your username.';
}

function requiredPassword(value) {
  if (value && value.trim()) {
    return true;
  }
  return 'Please enter your password.';
}

</script>

<template>
    <div class="main-container">
        <div class="content">
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
                <Form class="form" @submit.prevent="login" method="POST">
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
                    <div class="input-container">
                        <Field type="text" name="username" :rules="requiredUsername" placeholder="Enter Username" />
                        <span>
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <ErrorMessage class="error-message" name="username" />
                    <div class="input-container">
                        <Field name="password" :rules="requiredPassword" v-model="password" :type="showPassword ? 'text' : 'password'"
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
                </Form>
            </div>
        </div>
    </div>
</template>
  
<style scoped></style>