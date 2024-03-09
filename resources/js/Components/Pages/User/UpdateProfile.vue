<script setup>
import { ref, onMounted } from 'vue';

const gender = ref('');
</script>

<template>
    <div class="main-panel">
        <div class="content">
            <div class="update-container">
                <h3>Profile Setting</h3>
                <p>Update your profile here</p>
                <hr>
                <form action="">
                    <div class="avatar-container">
                        <p>Avatar</p>
                        <div class="image-file">
                            <div class="image-container">
                                <img src="../../../../../public/images/user.png" alt="">
                            </div>
                            <input type="file">
                        </div>
                    </div>
                    <hr>
                    <div class="input-updates">
                        <div class="input-fields">
                            <p>Firstname</p>
                            <div class="update-input-container">
                                <input class="update-input" type="text">
                            </div>
                        </div>
                        <div class="input-fields">
                            <p>Middlename</p>
                            <div class="update-input-container">
                                <input class="update-input" type="text">
                            </div>
                        </div>
                        <div class="input-fields">
                            <p>Lastname</p>
                            <div class="update-input-container">
                                <input class="update-input" type="text">
                            </div>
                        </div>
                        <div class="input-fields">
                            <p>Gender</p>
                            <div class="d-flex align-items-center duration" style="width: 70%; margin-bottom: -25px;">
                                <div class="selection mr-3">
                                    <input v-model="gender" id="male" name="male" type="radio" value="male">
                                    <label for="male">MALE</label>
                                </div>
                                <div class="selection">
                                    <input v-model="gender" id="female" name="female" type="radio" value="female">
                                    <label for="female">FEMALE</label>
                                </div>
                            </div>
                        </div>
                        <div class="input-fields">
                            <p>Birthdate</p>
                            <div class="update-input-container">
                                <input class="update-input" type="date">
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
                                <input class="update-input" type="email">
                            </div>
                        </div>
                        <div class="input-fields">
                            <p>Username</p>
                            <div class="update-input-container">
                                <input class="update-input" type="text">
                            </div>
                        </div>
                        <div class="input-fields">
                            <p>Current Password</p>
                            <div class="update-input-container">
                                <input class="update-input" type="text">
                            </div>
                        </div>
                        <div class="input-fields">
                            <p>New Password</p>
                            <div class="update-input-container">
                                <input class="update-input" type="text">
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
    width: 30%;
}

.image-file {
    display: flex;
    width: 70%;
    align-items: center;
}

.image-file input {
    border: 1px solid #535353;
    width: 100%;
    margin-left: -200px;
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
    }

    .image-file input {
        width: 100%;
        margin-left: -150px;
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
