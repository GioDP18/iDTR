<script setup>
import { ref } from 'vue';
import { Form, Field, ErrorMessage } from 'vee-validate';
import { useRouter } from 'vue-router';

const router = useRouter();

// Initializing reactive states
const showPassword = ref(false);
const showConfirmPassword = ref(false);
// Formm
const firstname = ref('');
const middlename = ref('');
const lastname = ref('');
const gender = ref('');
const birthdate = ref('');
const username = ref('');
const email = ref('');
const password = ref('');
const password_confirmation = ref('');


function togglePassword() {
    showPassword.value = !showPassword.value;
}

function toggleConfirmPassword() {
    showConfirmPassword.value = !showConfirmPassword.value;
}

function validateEmail(value) {
    if (!value) {
        return 'This field is required';
    }
    const regex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
    if (!regex.test(value)) {
        return 'Please provide a valid email';
    }
    return true;
}

function validateName(value) {
    if (!value) {
        return 'This field is required';
    }
    return true;
}

function validatePassword(value) {
    if (!value) {
        return 'This field is required';
    }
    const strongRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})/;
    if (strongRegex.test(value)) {
        return true;
    } else {
        return 'Password is too weak';
    }
    return true;
}

function validateConfirmPassword(value) {
    if (!value) {
        return 'This field is required';
    }
    if (value !== password.value) {
        return 'This password does not match';
    }
    return true;
}


const handleRegister = async () => {
  try {
    const response = await fetch('/api/auth/register', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        firstname: firstname.value,
        middlename: middlename.value,
        lastname: lastname.value,
        gender: gender.value,
        birthdate: birthdate.value,
        username: username.value,
        email: email.value,
        password: password.value,
        password_confirmation: password_confirmation.value,
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
    console.error('Error during registration:', error);
  }
};
</script>
<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-5 d-flex align-items-center justify-content-center"
                style="background-color: white; height: 100vh;">
                <div class="register-container">
                    <div class="register-form">
                        <form class="form" @submit.prevent="handleRegister" style="position:relative;">
                            <p class="form-title">Register your Account</p>
                            <div class="input-group flex-nowrap mt-4">
                                <Field v-model="firstname" name="firstname" :rules="validateName" type="text" class="form-control"
                                    placeholder="Fistname" />
                            </div>
                            <ErrorMessage class="error-message" name="firstname" />
                            <div class="input-group flex-nowrap mt-4">
                                <Field v-model="middlename" name="middlename" :rules="validateName" type="text" class="form-control"
                                    placeholder="Middlename" />
                            </div>
                            <ErrorMessage class="error-message" name="middlename" />
                            <div class="input-group flex-nowrap mt-3">
                                <Field v-model="lastname" name="lastname" :rules="validateName" type="text" class="form-control"
                                    placeholder="Lastname" />
                            </div>
                            <ErrorMessage class="error-message" name="lastname" />
                            <div class="input-group flex-nowrap mt-3">
                                <Field v-model="username" name="username" :rules="validateName" type="text" class="form-control"
                                    placeholder="Username" />
                                <span class="input-group-text">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                            </div>
                            <ErrorMessage class="error-message" name="username" />
                            <div class="mt-3 d-flex justify-content-around">
                                <div class="form-check form-check-inline">
                                    <Field v-model="gender" class="form-check-input" :rules="validateName" type="radio" name="gender"
                                        id="inlineRadio1" value="male" />
                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <Field v-model="gender" class="form-check-input" :rules="validateName" type="radio" name="gender"
                                        id="inlineRadio2" value="female" />
                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                </div>
                            </div>
                            <ErrorMessage class="error-message" name="gender" />
                            <div class="input-group flex-nowrap mt-3">
                                <Field v-model="birthdate" name="birthdate" :rules="validateName" type="date" class="form-control"
                                    placeholder="" />
                                <span class="input-group-text">
                                    <i class="fa-solid fa-calendar"></i>
                                </span>
                            </div>
                            <ErrorMessage class="error-message" name="birthdate" />
                            <div class="input-group flex-nowrap mt-3">
                                <Field v-model="email" name="email" :rules="validateEmail" type="email" class="form-control"
                                    placeholder="name@example.com" />
                                <span class="input-group-text">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                            </div>
                            <ErrorMessage class="error-message" name="email" />
                            <div class="input-group flex-nowrap mt-3">
                                <Field v-model="password" name="password"  :rules="validatePassword"
                                    :type="showPassword ? 'text' : 'password'" placeholder="Password"
                                    class="form-control" />
                                <span class="input-group-text" style="cursor:pointer;" @click="togglePassword">
                                    <i :class="['fa-solid', showPassword ? 'fa-eye-slash' : 'fa-eye']"></i>
                                </span>
                            </div>
                            <ErrorMessage class="error-message" name="password" />
                            <div class="input-group flex-nowrap mt-3">
                                <Field v-model="password_confirmation" name="password_confirmation" :rules="validateConfirmPassword"
                                    :type="showConfirmPassword ? 'text' : 'password'" placeholder="Confirm Password"
                                    class="form-control" />
                                <span class="input-group-text" style="cursor:pointer;" @click="toggleConfirmPassword">
                                    <i :class="['fa-solid', showConfirmPassword ? 'fa-eye-slash' : 'fa-eye']"></i>
                                </span>
                            </div>
                            <ErrorMessage class="error-message" name="password_confirmation" />
                            <button class="submit mt-4">
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
                    <img src="../../../../public/img/logo-transparent.png" alt="" style="width:12rem; height:10rem;">
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

input {
    font-size: 0.875rem;
    padding-left: 10px;
    padding: 8px;
}

span {
    padding: 8px;
}

span i {
    color: #9CA3AF;
    width: 1rem;
    height: 1rem;
}

  /* For modern browsers */
  input[type="date"]::-webkit-calendar-picker-indicator {
    display: none;
  }

  /* For Firefox */
  input[type="date"] {
    appearance: none;
    -moz-appearance: none;
    -webkit-appearance: none;
  }

.error-message {
    color: red;
    font-size: 0.75rem;
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

.input-group input {
    background-color: #fff;
    padding: 8px;
    padding-right: 3rem;
    font-size: 0.875rem;
    line-height: 1.25rem;
    width: 300px;
    border-radius: 0.5rem;
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
    margin-top: 5px;
    color: #6B7280;
    font-size: 0.875rem;
    line-height: 1.25rem;
    text-align: center;
}

.signup-link a {
    text-decoration: underline;
}
</style>