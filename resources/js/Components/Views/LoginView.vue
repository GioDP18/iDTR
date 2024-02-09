<script setup>
import { ref } from 'vue';
import { Field, Form, ErrorMessage } from 'vee-validate';
import { useRouter } from 'vue-router';

const router = useRouter();

const username = ref('');
const password = ref('');

const showPassword = ref(false);

function togglePassword() {
    showPassword.value = !showPassword.value;
}

const handleLogin = async() => {
    try {
        const response = await fetch('/api/auth/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                username: username.value,
                password: password.value,
                
            }),
        });

    // Handle response
    const data = await response.json();
    console.log(response)
    if (response.ok) {
        router.push('/user/dashboard');
    } else {
      alert(data.message);
    }
  } catch (error) {
    console.error('Error during login:', error);
  }
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
                <form class="form" @submit.prevent="handleLogin">
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
                        <Field type="text" name="username" :rules="requiredUsername" v-model="username" placeholder="Enter Username" />
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
                </form>
            </div>
        </div>
    </div>
</template>
  
<style scoped></style>
