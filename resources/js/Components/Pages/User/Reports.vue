<script setup>
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
                    <form action="">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                    <i><font-awesome-icon
                                        :icon="['fas', 'file']" /></i> Generate DTR Excel</h1>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="reportTitle" class="form-label">File Name</label>
                                    <input type="text" class="form-control" id="reportTitle"
                                        placeholder="What's your title?">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Set Date Range</label>
                                    <div class="d-flex">
                                        <div class="col-6">
                                            <label for="reportContent" class="form-label">Start</label>
                                            <input type="date" class="form-control" id="reportContent">
                                        </div>
                                        <div class="col-6">
                                            <label for="reportContent" class="form-label">End</label>
                                            <input type="date" class="form-control" id="reportContent">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn" style="background-color:#1572E8; color:white;"
                                    @click="saveNewReport">Save</button>
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
                    <form action="">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel"><i
                                        class="fa-solid fa-pen-to-square"></i> Create New report</h1>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="reportTitle" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="reportTitle"
                                        placeholder="What's your title?">
                                </div>
                                <div class="mb-3">
                                    <label for="reportContent" class="form-label">Content</label>
                                    <textarea class="form-control" id="reportContent" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn" style="background-color:#1572E8; color:white;"
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
                            style="margin:0; height:auto; flex-direction:row; overflow-x:auto;">
                            <!-- WEEK 1 -->
                            <div class="weekly-report">
                                <h5 class="text-center fw-bold mt-2">Week 1</h5>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="child1-container">
                                        <div class='card indgo pointer'>
                                            <div class="date-card">
                                                <div class="day">11</div>
                                                <div>
                                                    <div class="month">July</div>
                                                    <div class="year">2024</div>
                                                </div>
                                                <div class="updateButton" data-bs-toggle="modal" data-bs-target="#editContent">
                                                    <div class="rowButtons">
                                                        <div class="update">
                                                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cardcontent" data-bs-toggle="modal" data-bs-target="#viewContent">
                                                <h2>unique</h2>
                                                <p>Lisque persius interesset his et, in quot quidam persequeris vim, ad mea
                                                    essent possim iriure.</p>
                                                <div class="updateButton">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="child1-container">
                                        <div class='card indgo pointer'>
                                            <div class="date-card">
                                                <div class="day">11</div>
                                                <div>
                                                    <div class="month">July</div>
                                                    <div class="year">2024</div>
                                                </div>
                                                <div class="updateButton" data-bs-toggle="modal" data-bs-target="#editContent">
                                                    <div class="rowButtons">
                                                        <div class="update">
                                                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cardcontent" data-bs-toggle="modal" data-bs-target="#viewContent">
                                                <h2>unique</h2>
                                                <p>Lisque persius interesset his et, in quot quidam persequeris vim, ad mea
                                                    essent possim iriure.</p>
                                                <div class="updateButton">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="child1-container">
                                        <div class='card indgo pointer'>
                                            <div class="date-card">
                                                <div class="day">11</div>
                                                <div>
                                                    <div class="month">July</div>
                                                    <div class="year">2024</div>
                                                </div>
                                                <div class="updateButton" data-bs-toggle="modal" data-bs-target="#editContent">
                                                    <div class="rowButtons">
                                                        <div class="update">
                                                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cardcontent" data-bs-toggle="modal" data-bs-target="#viewContent">
                                                <h2>unique</h2>
                                                <p>Lisque persius interesset his et, in quot quidam persequeris vim, ad mea
                                                    essent possim iriure.</p>
                                                <div class="updateButton">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><div class="card-body" style="margin: -.5rem 0">
                                    <div class="child1-container">
                                        <div class='card indgo pointer'>
                                            <div class="date-card">
                                                <div class="day">11</div>
                                                <div>
                                                    <div class="month">July</div>
                                                    <div class="year">2024</div>
                                                </div>
                                                <div class="updateButton" data-bs-toggle="modal" data-bs-target="#editContent">
                                                    <div class="rowButtons">
                                                        <div class="update">
                                                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cardcontent" data-bs-toggle="modal" data-bs-target="#viewContent">
                                                <h2>unique</h2>
                                                <p>Lisque persius interesset his et, in quot quidam persequeris vim, ad mea
                                                    essent possim iriure.</p>
                                                <div class="updateButton">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="child1-container">
                                        <div class='card indgo pointer'>
                                            <div class="date-card">
                                                <div class="day">11</div>
                                                <div>
                                                    <div class="month">July</div>
                                                    <div class="year">2024</div>
                                                </div>
                                                <div class="updateButton" data-bs-toggle="modal" data-bs-target="#editContent">
                                                    <div class="rowButtons">
                                                        <div class="update">
                                                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cardcontent" data-bs-toggle="modal" data-bs-target="#viewContent">
                                                <h2>unique</h2>
                                                <p>Lisque persius interesset his et, in quot quidam persequeris vim, ad mea
                                                    essent possim iriure.</p>
                                                <div class="updateButton">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- WEEK 2 -->
                            <div class="weekly-report">
                                <h5 class="text-center fw-bold mt-2">Week 2</h5>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="child1-container">
                                        <div class='card indgo pointer'>
                                            <div class="date-card">
                                                <div class="day">11</div>
                                                <div>
                                                    <div class="month">July</div>
                                                    <div class="year">2024</div>
                                                </div>
                                                <div class="updateButton" data-bs-toggle="modal" data-bs-target="#editContent">
                                                    <div class="rowButtons">
                                                        <div class="update">
                                                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cardcontent" data-bs-toggle="modal" data-bs-target="#viewContent">
                                                <h2>unique</h2>
                                                <p>Lisque persius interesset his et, in quot quidam persequeris vim, ad mea
                                                    essent possim iriure.</p>
                                                <div class="updateButton">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="child1-container">
                                        <div class='card indgo pointer'>
                                            <div class="date-card">
                                                <div class="day">11</div>
                                                <div>
                                                    <div class="month">July</div>
                                                    <div class="year">2024</div>
                                                </div>
                                                <div class="updateButton" data-bs-toggle="modal" data-bs-target="#editContent">
                                                    <div class="rowButtons">
                                                        <div class="update">
                                                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cardcontent" data-bs-toggle="modal" data-bs-target="#viewContent">
                                                <h2>unique</h2>
                                                <p>Lisque persius interesset his et, in quot quidam persequeris vim, ad mea
                                                    essent possim iriure.</p>
                                                <div class="updateButton">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="child1-container">
                                        <div class='card indgo pointer'>
                                            <div class="date-card">
                                                <div class="day">11</div>
                                                <div>
                                                    <div class="month">July</div>
                                                    <div class="year">2024</div>
                                                </div>
                                                <div class="updateButton" data-bs-toggle="modal" data-bs-target="#editContent">
                                                    <div class="rowButtons">
                                                        <div class="update">
                                                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cardcontent" data-bs-toggle="modal" data-bs-target="#viewContent">
                                                <h2>unique</h2>
                                                <p>Lisque persius interesset his et, in quot quidam persequeris vim, ad mea
                                                    essent possim iriure.</p>
                                                <div class="updateButton">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="child1-container">
                                        <div class='card indgo pointer'>
                                            <div class="date-card">
                                                <div class="day">11</div>
                                                <div>
                                                    <div class="month">July</div>
                                                    <div class="year">2024</div>
                                                </div>
                                                <div class="updateButton" data-bs-toggle="modal" data-bs-target="#editContent">
                                                    <div class="rowButtons">
                                                        <div class="update">
                                                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cardcontent" data-bs-toggle="modal" data-bs-target="#viewContent">
                                                <h2>unique</h2>
                                                <p>Lisque persius interesset his et, in quot quidam persequeris vim, ad mea
                                                    essent possim iriure.</p>
                                                <div class="updateButton">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="child1-container">
                                        <div class='card indgo pointer'>
                                            <div class="date-card">
                                                <div class="day">11</div>
                                                <div>
                                                    <div class="month">July</div>
                                                    <div class="year">2024</div>
                                                </div>
                                                <div class="updateButton" data-bs-toggle="modal" data-bs-target="#editContent">
                                                    <div class="rowButtons">
                                                        <div class="update">
                                                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cardcontent" data-bs-toggle="modal" data-bs-target="#viewContent">
                                                <h2>unique</h2>
                                                <p>Lisque persius interesset his et, in quot quidam persequeris vim, ad mea
                                                    essent possim iriure.</p>
                                                <div class="updateButton">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- WEEK 3 -->
                            <div class="weekly-report">
                                <h5 class="text-center fw-bold mt-2">Week 3</h5>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="child1-container">
                                        <div class='card indgo pointer'>
                                            <div class="date-card">
                                                <div class="day">11</div>
                                                <div>
                                                    <div class="month">July</div>
                                                    <div class="year">2024</div>
                                                </div>
                                                <div class="updateButton" data-bs-toggle="modal" data-bs-target="#editContent">
                                                    <div class="rowButtons">
                                                        <div class="update">
                                                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cardcontent" data-bs-toggle="modal" data-bs-target="#viewContent">
                                                <h2>unique</h2>
                                                <p>Lisque persius interesset his et, in quot quidam persequeris vim, ad mea
                                                    essent possim iriure.</p>
                                                <div class="updateButton">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="child1-container">
                                        <div class='card indgo pointer'>
                                            <div class="date-card">
                                                <div class="day">11</div>
                                                <div>
                                                    <div class="month">July</div>
                                                    <div class="year">2024</div>
                                                </div>
                                                <div class="updateButton" data-bs-toggle="modal" data-bs-target="#editContent">
                                                    <div class="rowButtons">
                                                        <div class="update">
                                                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cardcontent" data-bs-toggle="modal" data-bs-target="#viewContent">
                                                <h2>unique</h2>
                                                <p>Lisque persius interesset his et, in quot quidam persequeris vim, ad mea
                                                    essent possim iriure.</p>
                                                <div class="updateButton">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="child1-container">
                                        <div class='card indgo pointer'>
                                            <div class="date-card">
                                                <div class="day">11</div>
                                                <div>
                                                    <div class="month">July</div>
                                                    <div class="year">2024</div>
                                                </div>
                                                <div class="updateButton" data-bs-toggle="modal" data-bs-target="#editContent">
                                                    <div class="rowButtons">
                                                        <div class="update">
                                                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cardcontent" data-bs-toggle="modal" data-bs-target="#viewContent">
                                                <h2>unique</h2>
                                                <p>Lisque persius interesset his et, in quot quidam persequeris vim, ad mea
                                                    essent possim iriure.</p>
                                                <div class="updateButton">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="child1-container">
                                        <div class='card indgo pointer'>
                                            <div class="date-card">
                                                <div class="day">11</div>
                                                <div>
                                                    <div class="month">July</div>
                                                    <div class="year">2024</div>
                                                </div>
                                                <div class="updateButton" data-bs-toggle="modal" data-bs-target="#editContent">
                                                    <div class="rowButtons">
                                                        <div class="update">
                                                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cardcontent" data-bs-toggle="modal" data-bs-target="#viewContent">
                                                <h2>unique</h2>
                                                <p>Lisque persius interesset his et, in quot quidam persequeris vim, ad mea
                                                    essent possim iriure.</p>
                                                <div class="updateButton">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="child1-container">
                                        <div class='card indgo pointer'>
                                            <div class="date-card">
                                                <div class="day">11</div>
                                                <div>
                                                    <div class="month">July</div>
                                                    <div class="year">2024</div>
                                                </div>
                                                <div class="updateButton" data-bs-toggle="modal" data-bs-target="#editContent">
                                                    <div class="rowButtons">
                                                        <div class="update">
                                                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cardcontent" data-bs-toggle="modal" data-bs-target="#viewContent">
                                                <h2>unique</h2>
                                                <p>Lisque persius interesset his et, in quot quidam persequeris vim, ad mea
                                                    essent possim iriure.</p>
                                                <div class="updateButton">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- WEEK 4 -->
                            <div class="weekly-report">
                                <h5 class="text-center fw-bold mt-2">Week 4</h5>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="child1-container">
                                        <div class='card indgo pointer'>
                                            <div class="date-card">
                                                <div class="day">11</div>
                                                <div>
                                                    <div class="month">July</div>
                                                    <div class="year">2024</div>
                                                </div>
                                                <div class="updateButton" data-bs-toggle="modal" data-bs-target="#editContent">
                                                    <div class="rowButtons">
                                                        <div class="update">
                                                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cardcontent" data-bs-toggle="modal" data-bs-target="#viewContent">
                                                <h2>unique</h2>
                                                <p>Lisque persius interesset his et, in quot quidam persequeris vim, ad mea
                                                    essent possim iriure.</p>
                                                <div class="updateButton">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="child1-container">
                                        <div class='card indgo pointer'>
                                            <div class="date-card">
                                                <div class="day">11</div>
                                                <div>
                                                    <div class="month">July</div>
                                                    <div class="year">2024</div>
                                                </div>
                                                <div class="updateButton" data-bs-toggle="modal" data-bs-target="#editContent">
                                                    <div class="rowButtons">
                                                        <div class="update">
                                                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cardcontent" data-bs-toggle="modal" data-bs-target="#viewContent">
                                                <h2>unique</h2>
                                                <p>Lisque persius interesset his et, in quot quidam persequeris vim, ad mea
                                                    essent possim iriure.</p>
                                                <div class="updateButton">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="child1-container">
                                        <div class='card indgo pointer'>
                                            <div class="date-card">
                                                <div class="day">11</div>
                                                <div>
                                                    <div class="month">July</div>
                                                    <div class="year">2024</div>
                                                </div>
                                                <div class="updateButton" data-bs-toggle="modal" data-bs-target="#editContent">
                                                    <div class="rowButtons">
                                                        <div class="update">
                                                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cardcontent" data-bs-toggle="modal" data-bs-target="#viewContent">
                                                <h2>unique</h2>
                                                <p>Lisque persius interesset his et, in quot quidam persequeris vim, ad mea
                                                    essent possim iriure.</p>
                                                <div class="updateButton">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="child1-container">
                                        <div class='card indgo pointer'>
                                            <div class="date-card">
                                                <div class="day">11</div>
                                                <div>
                                                    <div class="month">July</div>
                                                    <div class="year">2024</div>
                                                </div>
                                                <div class="updateButton" data-bs-toggle="modal" data-bs-target="#editContent">
                                                    <div class="rowButtons">
                                                        <div class="update">
                                                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cardcontent" data-bs-toggle="modal" data-bs-target="#viewContent">
                                                <h2>unique</h2>
                                                <p>Lisque persius interesset his et, in quot quidam persequeris vim, ad mea
                                                    essent possim iriure.</p>
                                                <div class="updateButton">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin: -.5rem 0">
                                    <div class="child1-container">
                                        <div class='card indgo pointer'>
                                            <div class="date-card">
                                                <div class="day">11</div>
                                                <div>
                                                    <div class="month">July</div>
                                                    <div class="year">2024</div>
                                                </div>
                                                <div class="updateButton" data-bs-toggle="modal" data-bs-target="#editContent">
                                                    <div class="rowButtons">
                                                        <div class="update">
                                                            <i><font-awesome-icon :icon="['fas', 'pen-to-square']" /></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cardcontent" data-bs-toggle="modal" data-bs-target="#viewContent">
                                                <h2>unique</h2>
                                                <p>Lisque persius interesset his et, in quot quidam persequeris vim, ad mea
                                                    essent possim iriure.</p>
                                                <div class="updateButton">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal to View More Content -->
            <div class="modal fade" id="viewContent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Content</h1>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <span>Lisque persius interesset his et, in quot quidam persequeris vim, ad mea essent
                                        possim iriure.</span>
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
            <div class="modal fade" id="editContent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Content</h1>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="reportTitle" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="reportTitle"
                                        placeholder="What's your title?">
                                </div>
                                <div class="mb-3">
                                    <label for="reportContent" class="form-label">Content</label>
                                    <textarea class="form-control" id="reportContent" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn" style="background-color:#1572E8; color:white;"
                                    @click="saveNewReport">Save</button>
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
