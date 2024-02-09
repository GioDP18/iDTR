<script setup>
import 'datatables.net-vue3';
import 'datatables.net-bs5';
import axios from 'axios';
import { ref,onMounted } from 'vue';
import moment from 'moment';

const timeRecord = ref([]);
const userID = localStorage.getItem('userID');

onMounted(async () => {
    await getTimeDataPM();
    initializeDataTables();
});

const getTimeDataPM = async () =>{
    try {
        const response = await axios.post('http://127.0.0.1:8000/api/auth/get-time-record-pm', {
            userID: userID
        }); 
        
        timeRecord.value = response.data.recordPM;
        
    } catch(error) {
        console.error(error)
    }
    
}

const handleTimeIn = async () =>{
    await axios.post('/api/auth/time-in-pm', {
        userID: userID
    })
    .then(response => {
        console.log(response.data)
    })
    .catch(error => {
        console.log(error.message)
    })
    await getTimeDataPM();
}
const handleTimeOut = async () =>{
    
    await axios.post('/api/auth/time-out-pm', {
        userID: userID
    })
    .then(response => {
        
        console.log(response.data)
    })
    .catch(error => {
        console.log(error.message)
    })
    await getTimeDataPM();
    
}

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
                            <h2 class="text-white pb-2 fw-bold">Daily Time Log: <span class="ml-2">P.M.</span></h2>
                        </div>
                        <div class="d-flex" style="gap:7px;">
                            <div>
                                <button class="log bg-success" @click="handleTimeIn">
                                    <span><i><font-awesome-icon :icon="['fas', 'clock']" /></i> Time-In</span>
                                </button>
                            </div>
                            <div>
                                <button class="log bg-danger" @click="handleTimeOut">
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
                                <tbody>
                                    <tr v-for="record in timeRecord" :key="record.id">
                                        <td>{{ formatDate(record.date) }}</td>
                                        <td>{{ formatTime(record.arrival_pm) }}</td>
                                        <td>{{ record.departure_pm ? formatTime(record.departure_pm) : '' }}</td>
                                        <td>{{ record.late_pm }}</td>
                                        <td>{{ record.hours_worked_pm }}</td>
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

<style scoped></style>