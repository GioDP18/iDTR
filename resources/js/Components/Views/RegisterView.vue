<script setup>
import { ref } from 'vue';
import { Form, Field, ErrorMessage } from 'vee-validate';
import { useRouter } from 'vue-router';
import axios from 'axios';
import store from '../../State/index.js'

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
const target_hours = ref(null);
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
    store.commit('setLoading', true)
    try {
        await axios.post('/api/auth/register', {
            firstname: firstname.value,
            middlename: middlename.value,
            lastname: lastname.value,
            gender: gender.value,
            birthdate: birthdate.value,
            username: username.value,
            target_hours: target_hours.value,
            email: email.value,
            password: password.value,
            password_confirmation: password_confirmation.value,

        })
            .then((response) => {
                if (response.data.success) {
                    swal({
                        icon: "success",
                        text: response.data.message,
                    });
                    router.push('/')
                }
                else {
                    swal({
                        icon: "error",
                        title: "Oops...",
                        text: response.data.message,
                    });
                }
            })
            .finally(() => {
                store.commit('setLoading', false)
            })

    } catch (error) {
        console.error('Error during registration:', error);
    }
}
</script>
<template>
    <div class="container-fluid">
        <div class="row">
            <div class="register-main-container col-sm-5 d-flex align-items-center justify-content-center">
                <div class="register-container">
                    <div class="register-form">
                        <Form class="form" @submit="handleRegister" style="position:relative;">
                            <p class="form-title">Register your account</p>
                            <div class="row gap-2">
                                <div class="col">
                                    <div class="mt-4" style="text-align: start;">
                                        <label for="firstname">First Name</label>
                                        <Field name="firstname" :rules="validateName" type="text" class="form-control"
                                            v-model="firstname" />
                                    </div>
                                    <ErrorMessage class="error-message" name="firstname" />
                                </div>
                                <div class="col">
                                    <div class="mt-4" style="text-align: start;">
                                        <label for="middle">Middle Name</label>
                                        <Field name="middlename" :rules="validateName" type="text" class="form-control"
                                            v-model="middlename" />
                                    </div>
                                    <ErrorMessage class="error-message" name="middlename" />
                                </div>
                            </div>
                            <div class="mt-3" style="text-align: start;">
                                <label for="lastname">Last Name</label>
                                <div class="input-group flex-nowrap ">
                                    <Field name="lastname" :rules="validateName" type="text" class="form-control"
                                        v-model="lastname" />
                                </div>
                            </div>
                            <ErrorMessage class="error-message" name="lastname" />
                            <div class="mt-3" style="text-align: start; display: flex; flex-direction: column;">
                                <label for="username">Username</label>
                                <div style="display: flex;" class="input-group flex-nowrap">
                                    <Field name="username" :rules="validateName" type="text" class="form-control"
                                        v-model="username" />
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                </div>
                            </div>
                            <ErrorMessage class="error-message" name="username" />
                            <div class="mt-3" style="text-align: start; display: flex; flex-direction: column;">
                                <label for="gender">Gender</label>
                                <div class="d-flex justify-content-evenly">
                                    <div class=" form-check form-check-inline">
                                        <Field class="form-check-input" :rules="validateName" type="radio" name="gender"
                                            id="inlineRadio1" value="male" v-model="gender" />
                                        <label class="form-check-label" for="inlineRadio1"
                                            style="margin-left: 4px">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <Field class="form-check-input" :rules="validateName" type="radio" name="gender"
                                            id="inlineRadio2" value="female" v-model="gender" />
                                        <label class="form-check-label" for="inlineRadio2"
                                            style="margin-left: 4px; margin-right: 4px">Female</label>
                                    </div>
                                </div>
                            </div>
                            <ErrorMessage class="error-message" name="gender" />
                            <div class="mt-3" style="text-align: start;">
                                <label for="birthdate">Birthdate</label>
                                <div class="input-group flex-nowrap ">
                                    <Field name="birthdate" :rules="validateName" type="date" class="form-control"
                                        placeholder="" v-model="birthdate" />
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                            <ErrorMessage class="error-message" name="birthdate" />
                            <div class="mt-3" style="text-align: start;">
                                <label for="birthdate">Target Hours</label>
                                <div class="input-group flex-nowrap ">
                                    <Field name="target_hours" :rules="validateName" type="text" class="form-control"
                                        placeholder="HHH:MM:SS" v-model="target_hours" />
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                            <ErrorMessage class="error-message" name="target_hours" />
                            <div class="mt-3" style="text-align: start;">
                                <label for="birthdate">Email</label>
                                <div class="input-group flex-nowrap">
                                    <Field v-model="email" name="email" :rules="validateEmail" type="email"
                                        class="form-control" />
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>
                                </div>
                            </div>
                            <ErrorMessage class="error-message" name="email" />
                            <div class="mt-3" style="text-align: start;">
                                <label for="birthdate">Password</label>
                                <div class="input-group flex-nowrap">
                                    <Field name="password" v-model="password" :rules="validatePassword"
                                        :type="showPassword ? 'text' : 'password'" class="form-control" />
                                    <span class="input-group-text" style="cursor:pointer;" @click="togglePassword">
                                        <i :class="['fa-solid', showPassword ? 'fa-eye-slash' : 'fa-eye']"></i>
                                    </span>
                                </div>
                            </div>
                            <ErrorMessage class="error-message" name="password" />
                            <div class="mt-3" style="text-align: start;">
                                <label for="birthdate">Confirm Password</label>
                                <div class="input-group flex-nowrap ">
                                    <Field name="password_confirmation" :rules="validateConfirmPassword"
                                        :type="showConfirmPassword ? 'text' : 'password'" class="form-control"
                                        v-model="password_confirmation" />
                                    <span class="input-group-text" style="cursor:pointer;"
                                        @click="toggleConfirmPassword">
                                        <i :class="['fa-solid', showConfirmPassword ? 'fa-eye-slash' : 'fa-eye']"></i>
                                    </span>
                                </div>
                            </div>
                            <ErrorMessage class="error-message" name="password_confirmation" />
                            <button type="submit" class="submit mt-4">
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
                style="background-color: #1269db; padding:8em">
                <div class="logo-container align-items-center text-center">
                    <img src="../../../../public/img/logo-transparent.png" alt="" style="width:12rem; height:10rem;">
                    <h5 class="text-light mt-4">Unlocking productivity, one clock-in at a time. iDTR: Where dedication
                        meets
                        efficiency, shaping a seamless journey through time records and unlocking the door to
                        professional
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

.register-main-container {
    background-color: white;
    overflow-y: auto;
    max-height: 100vh;
}

.register-container {
    display: flex;
    justify-content: start;
    box-shadow: 4px #000;
}

.register-form {
    background-color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 1rem;
    margin-top: 40vh;
}

.form {
    background-color: #fff;
    display: block;
    padding: 1rem;
    max-width: 350px;
    border-radius: 0.5rem;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    height: 100%;
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

@media screen and (max-width: 360px) {

    .register-form {
        margin-top: 0;
    }

    .register-main-container {
        overflow: hidden;
        max-height: 200vh;
    }
}
</style>
