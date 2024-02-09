<script setup>
import store from '../../../State/index.js'
import axios from 'axios';
import 'datatables.net-vue3';
import 'datatables.net-bs5';
import { ref, onMounted } from 'vue';
import moment from 'moment';

const timeRecord = ref([]);
const userID = localStorage.getItem('userID');

onMounted(async () => {
    await getTimeDataAM();
    initializeDataTables();
});

const getTimeDataAM = async () => {
    try {
        const response = await axios.post('http://127.0.0.1:8000/api/auth/get-time-record-am', {
            userID: userID
        });
        timeRecord.value = response.data.recordAM;
    } catch (error) {
        console.error(error);
    }
};

const handleTimeInAM = async () => {
    store.commit('setLoading', true)
    try {
        await axios.post('/api/auth/time-in-am', {
            userID: userID
        })
        .then((response) => {
            // console.log(response);
            if(response.data.success){
                swal({
                    icon: "success",
                    text: response.data.message,
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
        await getTimeDataAM();
    } catch (error) {
        console.error(error);
    }
};

const handleTimeOutAM = async () => {
    store.commit('setLoading', true)
    try {
        await axios.post('/api/auth/time-out-am', {
            userID: userID
        })
        .then((response) => {
            // console.log(response);
            if(response.data.success){
                swal({
                    icon: "success",
                    text: response.data.message,
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
        await getTimeDataAM();
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
                            <h2 class="text-white pb-2 fw-bold">Daily Time Log: <span class="ml-2">A.M.</span></h2>
                        </div>
                        <div class="d-flex" style="gap:7px;">
                            <div>
                                <button class="log bg-success" @click="handleTimeInAM">
                                    <span><i><font-awesome-icon :icon="['fas', 'clock']" /></i> Time-In</span>
                                </button>
                            </div>
                            <div>
                                <button class="log bg-danger" @click="handleTimeOutAM">
                                    <span><i><font-awesome-icon :icon="['fas', 'clock']" /></i> Time-Out</span>
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
                                        <th>Arrival</th>
                                        <th>Departure</th>
                                        <th>Late</th>
                                        <th>Number of Hours Worked</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    <tr v-for="record in timeRecord" :key="record.id">
                                        <th>{{ formatDate(record.date) }}</th>
                                        <th>{{ formatTime(record.arrival_am) }}</th>
                                        <th>{{ record.departure_am ? formatTime(record.departure_am) : '' }}</th>
                                        <th>{{ record.late_am }}</th>
                                        <th>{{ record.hours_worked_am }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
            </div>
        </footer>
    </div>
</template>

<style scoped>
.log {
    font-size: 17px;
    border-radius: 12px;
    color: rgb(218, 218, 218);
    border: none;
    padding: 2px;
    font-weight: 700;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition: all 0.4s;
}

.log span {
    border-radius: 10px;
    padding: 5px 15px;
    text-shadow: 0px 0px 20px #4b4b4b;
    width: 100%;
    display: flex;
    align-items: center;
    gap: 12px;
    color: inherit;
    transition: all 0.4s;
}
</style>