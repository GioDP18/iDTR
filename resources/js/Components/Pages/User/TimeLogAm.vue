<script setup>
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net-bs5';

DataTable.use(DataTablesCore);

const data = [
    ["January 1, 2001", "12:33 PM", "5:33 PM", "5:33 PM", "5:33 PM"],
    ["January 1, 2001", "12:33 PM", "5:33 PM", "5:33 PM", "5:33 PM"],
    ["January 1, 2001", "12:33 PM", "5:33 PM", "5:33 PM", "5:33 PM"],
];
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
                            <DataTable :data="data" id="dailyTimeLog" class="table table-striped table-hover" width="100%;">
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
                                    <tr>
                                        <td class="text-center" colspan="6">No Time Log.</td>
                                    </tr>
                                </tbody>
                            </DataTable>
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