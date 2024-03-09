<script setup>
import axios from "axios";
import store from '../../../State/index.js';
import { ref, onMounted } from 'vue';

const userID = localStorage.getItem('userID');
const firstname = ref('');
const middlename = ref('');
const lastname = ref('');
const gender = ref('');
const birthdate = ref('');
const email = ref('');
const avatar = ref('');
const new_avatar = ref(null);
const username = ref('');
const current_password = ref('');
const new_password = ref('');

onMounted(() => {
    getProfileInfo();
});

const getProfileInfo = async () => {
    try {
        await axios.get(`/api/auth/profile/${userID}`)
            .then((response) => {
                firstname.value = response.data.profile_info.intern.firstname;
                middlename.value = response.data.profile_info.intern.middlename;
                lastname.value = response.data.profile_info.intern.lastname;
                gender.value = response.data.profile_info.intern.gender;
                birthdate.value = response.data.profile_info.intern.birthdate;
                email.value = response.data.profile_info.intern.email;
                avatar.value = "../storage/" + response.data.profile_info.intern.avatar;
                username.value = response.data.profile_info.username;
            })
    } catch (error) {
        console.error('Error: ', error);
    }
}

const updateProfile = async () => {
    store.commit('setLoading', true)
    try {
        await axios.post(`/api/auth/update-profile`, {
            id: userID,
            firstname: firstname.value,
            middlename: middlename.value,
            lastname: lastname.value,
            gender: gender.value,
            birthdate: birthdate.value,
            email: email.value,
            avatar: new_avatar.value,
            username: username.value,
            current_password: current_password.value,
            new_password: new_password.value
        }, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
            .then((response) => {
                if (response.data.success) {
                    swal({
                        icon: "success",
                        text: response.data.message,
                    });
                    current_password.value = '';
                    new_password.value = '';
                }
                else {
                    swal({
                        icon: "error",
                        text: response.data.message,
                    });
                }
            })
            .finally(() => {
                store.commit('setLoading', false)
            })
    } catch (error) {
        console.error('Error: ', error);
    }
}

const handleChangeAvatar = (event) => {
    const file = event.target.files[0];
    new_avatar.value = file;

    if (file) {
        const reader = new FileReader();
        reader.onload = (event) => {
            const imageDataUrl = event.target.result;
            avatar.value = imageDataUrl;
        }
        reader.onerror = (error) => {
            console.error(error);
        }
        reader.readAsDataURL(file);
    }
}
</script>

<template>
    <div class="main-panel">
        <div class="content">
            <div class="update-container">
                <h3>Profile Setting</h3>
                <p>Update your profile here</p>
                <hr>
                <form action="" @submit.prevent="updateProfile">
                    <div class="avatar-container">
                        <p>Avatar</p>
                        <div class="image-file">
                            <div class="image-container">
                                <img :src="avatar" alt="">
                            </div>
                            <input type="file" @change="handleChangeAvatar">
                        </div>
                    </div>
                    <hr>
                    <div class="input-updates">
                        <div class="input-fields">
                            <p>Firstname</p>
                            <div class="update-input-container">
                                <input class="update-input pl-2" v-model="firstname" type="text">
                            </div>
                        </div>
                        <div class="input-fields">
                            <p>Middlename</p>
                            <div class="update-input-container">
                                <input class="update-input pl-2" v-model="middlename" type="text">
                            </div>
                        </div>
                        <div class="input-fields">
                            <p>Lastname</p>
                            <div class="update-input-container">
                                <input class="update-input pl-2" v-model="lastname" type="text">
                            </div>
                        </div>
                        <div class="input-fields">
                            <p>Gender</p>
                            <div class="d-flex align-items-center duration" style="width: 70%; margin-bottom: -25px;">
                                <div class="selection mr-3">
                                    <input v-model="gender" id="male" name="male" type="radio" value="male"
                                        :selected="gender === 'Male' ? 'selected' : ''">
                                    <label for="male">MALE</label>
                                </div>
                                <div class="selection">
                                    <input v-model="gender" id="female" name="female" type="radio" value="female"
                                        :selected="gender === 'Female' ? 'selected' : ''">
                                    <label for="female">FEMALE</label>
                                </div>
                            </div>
                        </div>
                        <div class="input-fields">
                            <p>Birthdate</p>
                            <div class="update-input-container">
                                <input class="update-input pl-2" v-model="birthdate" type="date">
                            </div>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="acount-container">
                        <h3>Account Setting</h3>
                        <p>Update your account details here</p>
                        <hr>
                    </div>
                    <div class="input-updates">
                        <div class="input-fields">
                            <p>Email</p>
                            <div class="update-input-container">
                                <input class="update-input pl-2" v-model="email" type="email">
                            </div>
                        </div>
                        <div class="input-fields">
                            <p>Username</p>
                            <div class="update-input-container">
                                <input class="update-input pl-2" v-model="username" type="text">
                            </div>
                        </div>
                        <div class="input-fields">
                            <p>Current Password</p>
                            <div class="update-input-container">
                                <input class="update-input pl-2" v-model="current_password" type="text">
                            </div>
                        </div>
                        <div class="input-fields">
                            <p>New Password</p>
                            <div class="update-input-container">
                                <input class="update-input pl-2" v-model="new_password" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="button-container">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.update-container {
    margin: 50px 50px 50px 50px;
}

.avatar-container {
    width: 100%;
    display: flex;
    gap: 50px;
}

.avatar-container p {
    font-weight: bold;
}

.image-container img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background-image: url("../../../../../public/images/user.png");
    background-size: cover;
}

.image-file {
    display: flex;
    width: 70%;
    align-items: center;
    gap: 60px
}

.image-file input {
    border: 1px solid #535353;
    width: 505px;
    border-radius: 6px;
}

.image-file input[type=file]::file-selector-button {
    padding: .2em .4em;
    background-color: #1269dbc0;
    transition: 1s;
    color: white;
    border: none;
}

.input-updates {
    display: flex;
    flex-direction: column;
}

.input-fields {
    display: flex;
    margin-bottom: 30px;
    width: 100%;
}

.input-fields p {
    font-weight: bold;
    width: 20%;
}

.update-input-container {
    display: flex;
    width: 80%;
}

.update-input-container input {
    border: 1px solid #535353;
    border-radius: 6px;
    width: 70%;
}

.divider {
    border-top: 3px solid black;
    margin: 40px 0 40px 0;
}

.button-container {
    width: 100%;
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.button-container button {
    width: 30%;
}

@media only screen and (max-width: 360px) {
    .update-container {
        width: 90%;
    }

    .update-container hr {
        width: 80%;
    }

    .update-container .divider {
        width: 80%;
    }

    .image-file {
        display: flex;
        flex-direction: column;
        gap: 0;
        margin-left: -70px;
    }

    .image-file input {
        width: 100%;
        margin-left: -10px;
        margin-top: 15px;
    }

    .input-fields {
        flex-direction: column;
    }

    .input-fields p,
    .acount-container p {
        width: 100%;
        margin-bottom: 5px;
    }

    .update-input-container input {
        width: 100%;
    }

    .button-container {
        display: flex;
        justify-content: start;
        width: 100%;
    }

    .button-container button {
        width: 79%;
    }
}
</style>
