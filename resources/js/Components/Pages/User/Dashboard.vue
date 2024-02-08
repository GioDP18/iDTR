<script setup>

</script>

<template>
    <div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row mt--2">
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title" style="font-weight:bold;">Completed Hours</div>
									<div class="d-flex flex-wrap justify-content-between pb-2 pt-4" style="position:relative; align-items:center">
										<div>
											<i style="font-size:6rem; color:#0ea511; opacity:70%"><font-awesome-icon :icon="['fas', 'hourglass-end']" /></i>
										</div>
										<div>
											<h1>0H 0M 0S</h1>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title" style="font-weight:bold;">Remaining Hours</div>
									<div class="d-flex flex-wrap justify-content-between pb-2 pt-4" style="position:relative; align-items:center">
										<div>
											<i style="font-size:6rem; color:#df2c35; opacity:70%"><font-awesome-icon :icon="['fas', 'hourglass-start']" /></i>
										</div>
										<div>
											<h1>486H 0M 0S</h1>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row d-flex mt-3" style="flex-direction:column;">
						<div>
							<h2 class="fw-bold">Status: </h2>
						</div>
						<div class="d-flex" style="align-items:center; margin-left:4.5rem;">
							<!-- <p style="width:2rem; height:1rem; background-color:#ef2121;"></p> -->
							<p style="width:2rem; height:1rem; background-color:#00ba00;"></p>
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

</style>