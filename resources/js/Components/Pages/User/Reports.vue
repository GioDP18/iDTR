<script setup>
import store from '../../../State/index.js'
import axios from 'axios';
import { ref, onMounted } from 'vue';
import moment from 'moment'
import { useRouter } from 'vue-router';

const router = useRouter();

const fileName = ref('');
const start_date = ref('');
const end_date = ref('');
const userID = localStorage.getItem('userID');
const title = ref('');
const content = ref('');
const reportObjects = ref([]);


onMounted(async () => {
    HandleGetReports();
});

const handleGenerate = async () => {
    store.commit('setLoading', true)

    let formattedStartDate = moment(start_date.value).format('YYYY-MM-DD');
    let formattedEndDate = moment(end_date.value).format('YYYY-MM-DD');

    try {
        await axios.post('http://127.0.0.1:8000/api/auth/generate', {
            userID: userID,
            start_date: formattedStartDate,
            end_date: formattedEndDate,
        })
        .then((response) => {
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
    } catch (error) {
        console.log(error);
    }
}

const HandleCreateReport = async () => {
    store.commit('setLoading', true)
    try {
        await axios.post('/api/auth/create-report', {
            userID: userID,
            title: title.value,
            content: content.value,
        })
        .then((response) => {
            console.log(response.data.message);
            if(response.data.success){
                swal({
                    icon: "success",
                    text: response.data.message,
                });
                router.push('reports')
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

const HandleUpdateReport = async (reportId, title, content) => {
    store.commit('setLoading', true)
    try {
        await axios.post('/api/auth/update-report', {
            reportID: reportId,
            title: title,
            content: content
            
        })
        .then((response) => {
            console.log(response.data.message);
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
    } catch (error) {
        console.error(error);
    }
}

const HandleGetReports = async () => {
    try {
        await axios.post('/api/auth/get-report', {
            userID: userID
        })
        .then((response) => {
            reportObjects.value = response.data.reports;
            console.log(response.data.reports);
        })
    } catch (error) {
        console.error(error);
    }
}

const formatDateMonth = (dateString) => {
  try {
    const formattedDate = moment(dateString).format('MMMM');
    return formattedDate;
  } catch (error) {
    console.error(error);
    return 'Invalid Date';
  }
};

const formatDateDay = (dateString) => {
  try {
    const formattedDate = moment(dateString).format('D');
    return formattedDate;
  } catch (error) {
    console.error(error);
    return 'Invalid Date';
  }
};

const truncateText = (text, limit) => {
    if (text.length <= limit) {
        return text;
    } else {
        return text.slice(0, limit) + '..'; 
    }
};

</script>

<template>
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row"
                        style="justify-content:space-between;">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Reports</h2>
                        </div>
                        <div class="d-flex gap-3">
                            <button class="create-report-btn" data-bs-toggle="modal"
                                data-bs-target="#generateDTR"><i><font-awesome-icon
                                        :icon="['fas', 'file']" /></i> Generate DTR </button>

                            <button class="create-report-btn" data-bs-toggle="modal"
                                data-bs-target="#createNewReport"><i><font-awesome-icon
                                        :icon="['fas', 'pen-to-square']" /></i> Create New Report </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal to Generate DTR -->
            <div class="modal fade" id="generateDTR" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form @submit.prevent="handleGenerate">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                    <i><font-awesome-icon
                                        :icon="['fas', 'file']" /></i> Generate DTR Excel</h1>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="reportTitle" class="form-label">File Name</label>
                                    <input type="text" v-model="fileName" class="form-control" id="reportTitle"
                                        placeholder="What's your title?">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Set Date Range</label>
                                    <div class="d-flex">
                                        <div class="col-6">
                                            <label for="reportContent" class="form-label">Start</label>
                                            <input type="date" v-model="start_date" class="form-control" id="reportContent">
                                        </div>
                                        <div class="col-6">
                                            <label for="reportContent" class="form-label">End</label>
                                            <input type="date" v-model="end_date" class="form-control" id="reportContent">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn" style="background-color:#1572E8; color:white;" >Save</button>
                                <button type="button" class="btn" id="closeCreateModal"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <!-- Modal to Create -->
            <div class="modal fade" id="createNewReport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form @submit.prevent="HandleCreateReport">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel"><i
                                        class="fa-solid fa-pen-to-square"></i> Create New report</h1>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="reportTitle" class="form-label">Title</label>
                                    <input v-model="title" type="text" class="form-control" id="reportTitle"
                                        placeholder="What's your title?">
                                </div>
                                <div class="mb-3">
                                    <label for="reportContent" class="form-label">Content</label>
                                    <textarea v-model="content" class="form-control" id="reportContent" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn" style="background-color:#1572E8; color:white;">Save</button>
                                <button type="button" class="btn" id="closeCreateModal"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <div class="page-inner mt--5">
                <div class="row mt--2">
                    <div class="col-md-12">
                        <div class="card full-height d-flex p-2"
                            style="margin:0; height:auto; flex-direction:row; overflow-x:auto;">
                            <template v-for="weekIndex in Math.ceil(reportObjects.length / 5)">
                                <div class="weekly-report">
                                    <h5 class="text-center fw-bold mt-2">Week {{ weekIndex }}</h5>
                                    <div v-for="(report, index) in reportObjects.slice((weekIndex - 1) * 5, weekIndex * 5)" :key="report.id" class="card-body" style="margin: -.5rem 0">
                                        <div class="child1-container">
                                            <div class='card indgo pointer'>
                                                <div class="date-card">
                                                    <div class="day">{{ (weekIndex - 1) * 5 + index + 1 }}</div>
                                                    <div>
                                                        <div class="month">{{ formatDateMonth(report.created_at) }}</div>
                                                        <div class="year">{{ formatDateDay(report.created_at) }}</div>
                                                    </div>
                                                    <div class="updateButton" data-bs-toggle="modal" :data-bs-target="'#editContent' + report.id">
                                                        <div class="rowButtons">
                                                            <div class="update">
                                                                <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="cardcontent" data-bs-toggle="modal" :data-bs-target="'#viewContent' + report.id">
                                                    <h2>{{ truncateText(report.title, 15) }}</h2>
                                                    <p>{{ truncateText(report.content, 130) }}</p>
                                                    <div class="updateButton">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal to View More Content -->
            <div v-for="report in reportObjects" :key="report.id"  class="modal fade" :id="'viewContent' + report.id" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ report.title }}</h1>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <span>{{ report.content }}</span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" id="closeCreateModal"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <!-- Modal for Edit-->
            <div v-for="report in reportObjects" :key="report.id" class="modal fade" :id="'editContent' + report.id" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true" ref="editModal">
                <div class="modal-dialog">
                    <form  @submit.prevent="HandleUpdateReport(report.id, report.title, report.content)">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Content</h1>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="reportTitle" class="form-label">Title</label>
                                    <input type="text" v-model="report.title" class="form-control" id="reportTitle"
                                        placeholder="What's your title?">
                                </div>
                                <div class="mb-3">
                                    <label for="reportContent" class="form-label">Content</label>
                                    <textarea class="form-control" v-model="report.content" id="reportContent" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn" style="background-color:#1572E8; color:white;">Save</button>
                                <button type="button" class="btn" id="closeCreateModal"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>

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
