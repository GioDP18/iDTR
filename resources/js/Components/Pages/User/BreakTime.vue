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
        <!-- Modal to Create -->
        <div class="modal fade" id="createBreakTime" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel"><i><font-awesome-icon
                                        :icon="['fas', 'clock']" /></i>
                                Start Break Time</h1>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="reportTitle" class="form-label">Break Type</label>
                                <input type="text" class="form-control" id="reportTitle" placeholder="Break Type">
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Duration</label>
                                <div class="d-flex align-items-center duration">
                                    <div class="selection mr-3">
                                        <input id="minutes" name="duration" type="radio" value="00:30:00">
                                        <label for="minutes">30 Minutes</label>
                                    </div>
                                    <div class="selection">
                                        <input id="hour" name="duration" type="radio" value="01:00:00">
                                        <label for="hour">1 Hour</label>
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