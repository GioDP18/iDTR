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
                        <div>
                            <button class="create-report-btn" data-bs-toggle="modal" data-bs-target="#createNewReport"><i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i> Create New Report </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="createNewReport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel"><i
                                        class="fa-solid fa-pen-to-square"></i> Create New report</h1>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="reportTitle" class="form-label">Title</label>
                                    <input type="email" class="form-control" id="reportTitle"
                                        placeholder="What's your title?">
                                </div>
                                <div class="mb-3">
                                    <label for="reportContent" class="form-label">Content</label>
                                    <textarea class="form-control" id="reportContent" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn" style="background-color:#6910A0; color:white;"
                                    @click="saveNewReport">Save</button>
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
                            style="margin:0; height:auto; flex-direction:row; gap:17px; overflow-x:auto;">
                            <!-- WEEK 1 -->
                            <div class="weekly-report">
                                <h5 class="text-center fw-bold mt-2">Week 1</h5>
                                <div class="card-body" style="margin:-.5rem 0">
                                    <div class="report-card">
                                        <div class="report-glow"></div>
                                        <div class="report-border-glow"></div>
                                        <div class="report-title">January 21, 2024</div>
                                        <div class="report-content">Title</div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="report-card">
                                        <div class="report-glow"></div>
                                        <div class="report-border-glow"></div>
                                        <div class="report-title">Welcome To Uiverse</div>
                                        <div class="report-content">Contribute to Open Source UI Elements</div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="report-card">
                                        <div class="report-glow"></div>
                                        <div class="report-border-glow"></div>
                                        <div class="report-title">Welcome To Uiverse</div>
                                        <div class="report-content">Contribute to Open Source UI Elements</div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="report-card">
                                        <div class="report-glow"></div>
                                        <div class="report-border-glow"></div>
                                        <div class="report-title">Welcome To Uiverse</div>
                                        <div class="report-content">Contribute to Open Source UI Elements</div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="report-card">
                                        <div class="report-glow"></div>
                                        <div class="report-border-glow"></div>
                                        <div class="report-title">Welcome To Uiverse</div>
                                        <div class="report-content">Contribute to Open Source UI Elements</div>
                                    </div>
                                </div>
                                <h5 class="text-center fw-bold mt-1">Week 1</h5>
                            </div>

                            <!-- WEEK 2 -->
                            <div class="weekly-report">
                                <h5 class="text-center fw-bold mt-2">Week 2</h5>
                                <div class="card-body" style="margin:-.5rem 0">
                                    <div class="report-card">
                                        <div class="report-glow"></div>
                                        <div class="report-border-glow"></div>
                                        <div class="report-title">Welcome To Uiverse</div>
                                        <div class="report-content">Contribute to Open Source UI Elements</div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="report-card">
                                        <div class="report-glow"></div>
                                        <div class="report-border-glow"></div>
                                        <div class="report-title">Welcome To Uiverse</div>
                                        <div class="report-content">Contribute to Open Source UI Elements</div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="report-card">
                                        <div class="report-glow"></div>
                                        <div class="report-border-glow"></div>
                                        <div class="report-title">Welcome To Uiverse</div>
                                        <div class="report-content">Contribute to Open Source UI Elements</div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="report-card">
                                        <div class="report-glow"></div>
                                        <div class="report-border-glow"></div>
                                        <div class="report-title">Welcome To Uiverse</div>
                                        <div class="report-content">Contribute to Open Source UI Elements</div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="report-card">
                                        <div class="report-glow"></div>
                                        <div class="report-border-glow"></div>
                                        <div class="report-title">Welcome To Uiverse</div>
                                        <div class="report-content">Contribute to Open Source UI Elements</div>
                                    </div>
                                </div>
                                <h5 class="text-center fw-bold mt-1">Week 2</h5>
                            </div>

                            <!-- WEEK 3 -->
                            <div class="weekly-report">
                                <h5 class="text-center fw-bold mt-2">Week 3</h5>
                                <div class="card-body" style="margin:-.5rem 0">
                                    <div class="report-card">
                                        <div class="report-glow"></div>
                                        <div class="report-border-glow"></div>
                                        <div class="report-title">Welcome To Uiverse</div>
                                        <div class="report-content">Contribute to Open Source UI Elements</div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="report-card">
                                        <div class="report-glow"></div>
                                        <div class="report-border-glow"></div>
                                        <div class="report-title">Welcome To Uiverse</div>
                                        <div class="report-content">Contribute to Open Source UI Elements</div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="report-card">
                                        <div class="report-glow"></div>
                                        <div class="report-border-glow"></div>
                                        <div class="report-title">Welcome To Uiverse</div>
                                        <div class="report-content">Contribute to Open Source UI Elements</div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="report-card">
                                        <div class="report-glow"></div>
                                        <div class="report-border-glow"></div>
                                        <div class="report-title">Welcome To Uiverse</div>
                                        <div class="report-content">Contribute to Open Source UI Elements</div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="report-card">
                                        <div class="report-glow"></div>
                                        <div class="report-border-glow"></div>
                                        <div class="report-title">Welcome To Uiverse</div>
                                        <div class="report-content">Contribute to Open Source UI Elements</div>
                                    </div>
                                </div>
                                <h5 class="text-center fw-bold mt-1">Week 3</h5>
                            </div>

                            <!-- WEEK 4 -->
                            <div class="weekly-report">
                                <h5 class="text-center fw-bold mt-2">Week 4</h5>
                                <div class="card-body" style="margin:-.5rem 0">
                                    <div class="report-card">
                                        <div class="report-glow"></div>
                                        <div class="report-border-glow"></div>
                                        <div class="report-title">Welcome To Uiverse</div>
                                        <div class="report-content">Contribute to Open Source UI Elements</div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="report-card">
                                        <div class="report-glow"></div>
                                        <div class="report-border-glow"></div>
                                        <div class="report-title">Welcome To Uiverse</div>
                                        <div class="report-content">Contribute to Open Source UI Elements</div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="report-card">
                                        <div class="report-glow"></div>
                                        <div class="report-border-glow"></div>
                                        <div class="report-title">Welcome To Uiverse</div>
                                        <div class="report-content">Contribute to Open Source UI Elements</div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="report-card">
                                        <div class="report-glow"></div>
                                        <div class="report-border-glow"></div>
                                        <div class="report-title">Welcome To Uiverse</div>
                                        <div class="report-content">Contribute to Open Source UI Elements</div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="report-card">
                                        <div class="report-glow"></div>
                                        <div class="report-border-glow"></div>
                                        <div class="report-title">Welcome To Uiverse</div>
                                        <div class="report-content">Contribute to Open Source UI Elements</div>
                                    </div>
                                </div>
                                <h5 class="text-center fw-bold mt-1">Week 4</h5>
                            </div>
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

<script setup>
</script>

<style scoped></style>