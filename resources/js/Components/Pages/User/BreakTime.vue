<script setup>
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net-bs5';

DataTable.use(DataTablesCore);

const data = [
    ["January 1, 2001", "12:33 PM", "5:33 PM", "5:33 PM"],
    ["January 1, 2001", "12:33 PM", "5:33 PM", "5:33 PM"],
    ["January 1, 2001", "12:33 PM", "5:33 PM", "5:33 PM"],
];

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
                                <button class="log bg-success" @click="handleTimeBreak">
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
                            <DataTable :data="data" id="dailyTimeLog" class="table table-striped table-hover" width="100%;">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time Started</th>
                                        <th>Time Ended</th>
                                        <th>Break Time Duration</th>
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

<style scoped></style>