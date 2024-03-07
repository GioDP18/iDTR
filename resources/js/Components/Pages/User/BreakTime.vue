<script setup>
import 'datatables.net-vue3';
import 'datatables.net-bs5';
import { ref, onMounted } from 'vue';
import axios from 'axios';
import store from '../../../State/index.js';
import moment from 'moment';


const breakObjects = ref([]);
const userID = localStorage.getItem('userID');
const break_type = ref('');
const time_period = ref('');
const duration = ref('');

onMounted(async () => {
    await breaks();
    initializeDataTables();
});

const breaks = async () => {
    try {
        const response = await axios.get(`/api/auth/break/${userID}`)
        breakObjects.value = response.data.break;
        
    } catch (error) {
        console.error('Error during fetch:', error);
    }
}

const HandleCreateBreak = async () => {
    store.commit('setLoading', true)
    try {
        await axios.post('/api/auth/create-break', {
            userID: userID,
            break_type: break_type.value,
            time_period: time_period.value,
            duration: duration.value,
        })
        .then((response) => {
            console.log(response.data.message);
            if(response.data.success){
                swal({
                    icon: "success",
                    text: response.data.message,
                    
                }).then(() => {
                    window.location.href = 'timeLogBreak';
                });
                
            }
            else{
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
        console.error(error);
    }
};

const formatTime = (timeString) => {
  try {
    const formattedTime = moment(timeString, 'HH:mm:ss').format('hh:mm A');
    return formattedTime;
  } catch (error) {
    console.error(error);
    return 'Invalid Time';
  }
};

const formatDate = (dateString) => {
  try {
    const formattedDate = moment(dateString).format('MMM D, YYYY');
    return formattedDate;
  } catch (error) {
    console.error(error);
    return 'Invalid Date';
  }
};

const initializeDataTables = () => {
    $(document).ready(function () {
        $('#dailyTimeLog').DataTable();
    });
}


</script>

<template>
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex justify-content-between align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Daily Time Log: <span class="ml-2">Break Time</span></h2>
                        </div>
                        <div class="d-flex" style="gap:7px;">
                            <div>
                                <button class="log bg-success" data-bs-toggle="modal" data-bs-target="#createBreakTime">
                                    <span><i><font-awesome-icon :icon="['fas', 'clock']" /></i> Start Break Time</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-inner mt--5">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dailyTimeLog" class="table table-striped table-hover" width="100%;">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time Started</th>
                                        <th>Time Ended</th>
                                        <th>Break Time Duration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="time in breakObjects" :key="time.id">
                                        <th>{{ formatDate(time.date) }}</th>
                                        <th>{{ formatTime(time.date) }}</th>
                                        <th>{{ time.time_ended ? formatTime(time.time_ended) : '' }}</th>
                                        <th>{{ time.duration }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal to Create -->
        <div class="modal fade" id="createBreakTime" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form @submit.prevent="HandleCreateBreak">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel"><i><font-awesome-icon
                                        :icon="['fas', 'clock']" /></i>
                                Start Break Time</h1>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="reportTitle" class="form-label">Break Type</label>
                                <input v-model="break_type" type="text" class="form-control" id="reportTitle" placeholder="Break Type">
                            </div>
                            <div class="mb-2">
                                <label for="gender" class="form-label">Duration</label>
                                <div class="d-flex align-items-center duration">
                                    <div class="selection mr-3">
                                        <input v-model="duration" id="minutes" name="duration" type="radio" value="00:30:00">
                                        <label for="minutes">30 Minutes</label>
                                    </div>
                                    <div class="selection">
                                        <input v-model="duration" id="hour" name="duration" type="radio" value="01:00:00">
                                        <label for="hour">1 Hour</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Time Period</label>
                                <div class="d-flex align-items-center duration">
                                    <div class="selection mr-3">
                                        <input v-model="time_period" id="AM" name="time_period" type="radio" value="AM">
                                        <label for="AM">AM</label>
                                    </div>
                                    <div class="selection">
                                        <input v-model="time_period" id="PM" name="time_period" type="radio" value="PM">
                                        <label for="PM">PM</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn" style="background-color:#1572E8; color:white;"
                                @click="handleTimeBreak">Save</button>
                            <button type="button" class="btn" id="closeCreateModal" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
            </div>
        </footer>
    </div>
</template>

<style scoped></style>