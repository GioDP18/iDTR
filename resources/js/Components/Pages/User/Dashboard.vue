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
				<div class="container text-center">
					<div class="div-2">
						<div class="div-3">
							<div class="column">
								<div class="div-4">
									<div class="header-greeting">
										<div class="div-6">
											<div class="column-2">
												<div class="div-7">
													<div class="greeting-text">Good Morning, Gio</div>
													<div class="date-text">{{ currentDate }}</div>
													<div class="time-text">{{ activeTime }}</div>
												</div>
											</div>
											<div class="column-3">
												<img loading="lazy"
													src="https://cdn.builder.io/api/v1/image/assets/TEMP/e3498fa64bb85205b8e62e86e91d3e4f4f41dbf132570bdf62fefce7f680fefe?apiKey=ff3368bd5fd6477688619c390d91ee7a&"
													class="img" />
											</div>
										</div>
									</div>
									<div class="div-11">
										<div class="div-12">
											<div class="card-time">
												<div class="div-13">
													<div class="img-2">
														<i class=""
															style="font-size:50px; color:#0ea511; opacity:70%"><font-awesome-icon
																:icon="['fas', 'hourglass-end']" /></i>
													</div>
													<div class="div-14">
														<div class="hour-text">Completed Hours</div>
														<div class="hour-time">6H 45M 13S</div>
													</div>
												</div>
											</div>
											<div class="card-time">
												<div class="div-17">
													<div class="img-2">
														<i style="font-size:50px; color:#df2c35; opacity:70%"><font-awesome-icon
																:icon="['fas', 'hourglass-start']" /></i>
													</div>
													<div class="div-18">
														<div class="hour-text">Remaining Hours</div>
														<div class="hour-time">6H 45M 13S</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="column-6">
								<div class="calendar-card">
									<div id="calendar"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="row d-flex mt-3" style="flex-direction:column;">
						<div>
							<h2 class="fw-bold">Status:</h2>
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
.div-2 {
	width: 100%;
}

@media (max-width: 991px) {
	.div-2 {
		max-width: 100%;
		margin-top: 40px;
	}
}

.div-3 {
	gap: 20px;
	display: flex;
}

@media (max-width: 991px) {
	.div-3 {
		flex-direction: column;
		align-items: stretch;
		gap: 0px;
	}
}

.column {
	display: flex;
	flex-direction: column;
	line-height: normal;
	width: 67%;
	margin-left: 0px;
}

@media (max-width: 991px) {
	.column {
		width: 100%;
	}
}

.div-4 {
	display: flex;
	flex-grow: 1;
	flex-direction: column;
}

@media (max-width: 991px) {
	.div-4 {
		max-width: 100%;
		margin-top: 27px;
	}
}

.header-greeting {
	border-radius: 15px;
	box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
	background-color: #fff;
	padding-left: 36px;
}

@media (max-width: 991px) {
	.header-greeting {
		max-width: 100%;
		padding-left: 20px;
	}
}

.div-6 {
	gap: 20px;
	display: flex;
}

@media (max-width: 991px) {
	.div-6 {
		flex-direction: column;
		align-items: stretch;
		gap: 0px;
	}
}

.column-2 {
	display: flex;
	flex-direction: column;
	line-height: normal;
	width: 50%;
	margin-left: 0px;
	margin: 10px;
	text-align: left;
}

@media (max-width: 991px) {
	.column-2 {
		width: 100%;
	}
}

.div-7 {
	display: flex;
	flex-direction: column;
	align-self: stretch;
	color: rgba(0, 0, 0, 0.7);
	margin: auto 0;
}

@media (max-width: 991px) {
	.div-7 {
		margin-top: 29px;
	}
}

.greeting-text {
	white-space: nowrap;
	font: 500 30px Inter, sans-serif;
}

@media (max-width: 991px) {
	.greeting-text {
		white-space: initial;
	}
}

.date-text {
	margin-top: 15px;
	font: 400 18px Inter, sans-serif;
}

.time-text {
	color: var(--Red, #eb455f);
	margin-top: 30px;
	font: 700 28px Inter, sans-serif;
}

.column-3 {
	display: flex;
	flex-direction: column;
	line-height: normal;
	width: 50%;
	margin-left: 20px;
}

@media (max-width: 991px) {
	.column-3 {
		width: 100%;
	}
}

.img {
	aspect-ratio: 1.35;
	object-fit: auto;
	object-position: center;
	width: 100%;
	z-index: 10;
	margin-top: -69px;
	flex-grow: 1;
}

@media (max-width: 991px) {
	.img {
		margin-top: -63px;
	}
}

.div-11 {
	margin-top: 22px;
}

@media (max-width: 991px) {
	.div-11 {
		max-width: 100%;
	}
}

.div-12 {
	gap: 20px;
	display: flex;
}

@media (max-width: 991px) {
	.div-12 {
		flex-direction: column;
		align-items: stretch;
		gap: 0px;
	}
}

.card-time {
	display: flex;
	flex-direction: column;
	line-height: normal;
	width: 50%;
	margin-left: 0px;
}

@media (max-width: 991px) {
	.card-time {
		width: 100%;
	}
}

.div-13 {
	border-radius: 0px 0px 15px 15px;
	box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
	background-color: #fff;
	display: flex;
	flex-grow: 1;
	justify-content: space-between;
	gap: 13px;
	width: 100%;
	padding: 29px 25px;
}

@media (max-width: 991px) {
	.div-13 {
		margin-top: 24px;
		padding: 0 20px;
	}
}

.img-2 {
	aspect-ratio: 0.6;
	object-fit: auto;
	object-position: center;
	width: 44px;
	align-self: start;
}

.div-14 {
	display: flex;
	flex-grow: 1;
	flex-basis: 0%;
	flex-direction: column;
}

.hour-text {
	color: rgba(0, 0, 0, 0.7);
	font: 500 18px Inter, sans-serif;
}

.hour-time {
	color: #58494b;
	align-self: end;
	margin-top: 20px;
	white-space: nowrap;
	font: 700 20px Inter, sans-serif;
}

@media (max-width: 991px) {
	.div-16 {
		white-space: initial;
	}
}

.div-17 {
	border-radius: 0px 0px 15px 15px;
	box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
	background-color: #fff;
	display: flex;
	flex-grow: 1;
	justify-content: space-between;
	gap: 14px;
	width: 100%;
	padding: 29px 23px;
}

@media (max-width: 991px) {
	.div-17 {
		margin-top: 24px;
		padding: 0 20px;
	}
}

.img-3 {
	aspect-ratio: 0.6;
	object-fit: auto;
	object-position: center;
	width: 44px;
	fill: var(--Red, #eb455f);
	align-self: start;
}

.div-18 {
	display: flex;
	flex-grow: 1;
	flex-basis: 0%;
	flex-direction: column;
}

.div-19 {
	color: rgba(0, 0, 0, 0.7);
	font: 500 20px Inter, sans-serif;
}

.div-20 {
	color: #58494b;
	align-self: end;
	margin-top: 37px;
	white-space: nowrap;
	font: 700 25px Inter, sans-serif;
}

@media (max-width: 991px) {
	.div-20 {
		white-space: initial;
	}
}

.column-6 {
	display: flex;
	flex-direction: column;
	line-height: normal;
	width: 33%;
	margin-left: 20px;
}

@media (max-width: 991px) {
	.column-6 {
		width: 100%;
	}
}

.calendar-card {
	border-radius: 15px 15px 15px 15px;
	box-shadow: 2px 16px 19px 0px rgba(0, 0, 0, 0.09);
	background-color: #fff;
	display: flex;
	width: 100%;
	flex-grow: 1;
	flex-direction: column;
	font-size: 16px;
	color: var(--Base-Gray-80, #4a5660);
	font-weight: 600;
	text-align: center;
	line-height: 112.5%;
	margin: 0 auto;
	padding: 24px;
}

@media (max-width: 991px) {
	.div-21 {
		margin-top: 27px;
		padding: 0 20px;
	}
}

.div-22 {
	justify-content: space-between;
	display: flex;
	gap: 20px;
	font-size: 14px;
	line-height: 100%;
	padding: 0 1px;
}

.img-4 {
	aspect-ratio: 1;
	object-fit: auto;
	object-position: center;
	width: 16px;
}

.div-23 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
	flex-grow: 1;
	flex-basis: auto;
}

.img-5 {
	aspect-ratio: 1;
	object-fit: auto;
	object-position: center;
	width: 16px;
}

.div-24 {
	display: flex;
	margin-top: 22px;
	gap: 11px;
	font-size: 10px;
	color: var(--Base-Gray-40, #b5bec6);
	text-transform: uppercase;
	letter-spacing: 1.5px;
	line-height: 120%;
	padding: 4px 3px;
}

.div-25 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
	flex-grow: 1;
}

.div-26 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-27 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-28 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-29 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-30 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-31 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-32 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
	flex-grow: 1;
}

.div-33 {
	display: flex;
	margin-top: 22px;
	gap: 18px;
	white-space: nowrap;
	padding: 8px 11px 8px 0;
}

@media (max-width: 991px) {
	.div-33 {
		white-space: initial;
	}
}

.div-34 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
	flex-grow: 1;
}

.div-35 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-36 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-37 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-38 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-39 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-40 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
	flex-grow: 1;
}

.div-41 {
	display: flex;
	margin-top: 8px;
	gap: 18px;
	white-space: nowrap;
	padding: 8px 11px 8px 0;
}

@media (max-width: 991px) {
	.div-41 {
		white-space: initial;
	}
}

.div-42 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
	flex-grow: 1;
}

.div-43 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-44 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-45 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-46 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-47 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-48 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
	flex-grow: 1;
}

.div-49 {
	align-items: center;
	display: flex;
	margin-top: 8px;
	gap: 13px;
	white-space: nowrap;
	padding: 0 5px;
}

@media (max-width: 991px) {
	.div-49 {
		white-space: initial;
	}
}

.div-50 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
	align-self: stretch;
	flex-grow: 1;
	margin: auto 0;
}

.div-51 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
	align-self: stretch;
	margin: auto 0;
}

.div-52 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
	align-self: stretch;
	margin: auto 0;
}

.div-53 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
	align-self: stretch;
	margin: auto 0;
}

.div-54 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
	justify-content: center;
	align-items: center;
	border-radius: 29px;
	background-color: var(--Secondary-100, #f04d23);
	align-self: stretch;
	aspect-ratio: 1;
	height: 30px;
	color: var(--Base-White, #fff);
	padding: 0 5px;
}

@media (max-width: 991px) {
	.div-54 {
		white-space: initial;
	}
}

.div-55 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
	align-self: stretch;
	margin: auto 0;
}

.div-56 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
	align-self: stretch;
	flex-grow: 1;
	margin: auto 0;
}

.div-57 {
	display: flex;
	margin-top: 8px;
	gap: 18px;
	white-space: nowrap;
	padding: 8px 11px 8px 0;
}

@media (max-width: 991px) {
	.div-57 {
		white-space: initial;
	}
}

.div-58 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
	flex-grow: 1;
}

.div-59 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-60 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-61 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-62 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-63 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-64 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
	flex-grow: 1;
}

.div-65 {
	display: flex;
	margin-top: 8px;
	gap: 18px;
	white-space: nowrap;
	padding: 8px 80px 8px 0;
}

@media (max-width: 991px) {
	.div-65 {
		padding-right: 20px;
		white-space: initial;
	}
}

.div-66 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
	flex-grow: 1;
}

.div-67 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
}

.div-68 {
	font-feature-settings: "clig" off, "liga" off;
	font-family: Avenir Next LT Pro, sans-serif;
	flex-grow: 1;
}

.div-69 {
	display: flex;
	margin-top: 93px;
	width: 598px;
	max-width: 100%;
	justify-content: space-between;
	gap: 20px;
	font-size: 16px;
	color: rgba(0, 0, 0, 0.5);
	font-weight: 500;
	padding: 0 20px;
}

@media (max-width: 991px) {
	.div-69 {
		flex-wrap: wrap;
		margin-top: 40px;
	}
}

.div-70 {
	font-family: Inter, sans-serif;
}

.div-71 {
	font-family: Inter, sans-serif;
}

.div-72 {
	margin-top: 15px;
	width: 100%;
}

@media (max-width: 991px) {
	.div-72 {
		max-width: 100%;
	}
}

.div-73 {
	gap: 20px;
	display: flex;
}

@media (max-width: 991px) {
	.div-73 {
		flex-direction: column;
		align-items: stretch;
		gap: 0px;
	}
}

.activity-card {
	display: flex;
	flex-direction: column;
	line-height: normal;
	width: 50%;
	margin-left: 0px;
}

@media (max-width: 991px) {
	.activity-card {
		width: 100%;
	}
}

.div-74 {
	border-radius: 15px;
	box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
	background-color: #fff;
	width: 470px;
	max-width: 100%;
	height: 376px;
	margin: 0 auto;
}

@media (max-width: 991px) {
	.div-74 {
		margin-top: 29px;
	}
}

.column-8 {
	display: flex;
	flex-direction: column;
	line-height: normal;
	width: 50%;
	margin-left: 20px;
}

@media (max-width: 991px) {
	.column-8 {
		width: 100%;
	}
}

.div-75 {
	border-radius: 15px;
	box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
	background-color: #fff;
	display: flex;
	flex-grow: 1;
	align-items: start;
	justify-content: space-between;
	gap: 20px;
	width: 100%;
	padding: 41px 55px 9px;
}

@media (max-width: 991px) {
	.div-75 {
		max-width: 100%;
		margin-top: 29px;
		flex-wrap: wrap;
		padding: 0 20px;
	}
}

.div-76 {
	display: flex;
	margin-top: 20px;
	flex-basis: 0%;
	flex-direction: column;
}

@media (max-width: 991px) {
	.div-76 {
		display: none;
	}
}

.div-77 {
	border-radius: 29px;
	background-color: var(--Red, #eb455f);
	height: 15px;
}

.div-78 {
	background-color: rgba(0, 0, 0, 0.5);
	height: 82px;
}

.div-79 {
	border-radius: 29px;
	background-color: var(--Red, #eb455f);
	height: 15px;
}

.div-80 {
	background-color: rgba(0, 0, 0, 0.5);
	height: 82px;
}

.div-81 {
	border-radius: 29px;
	background-color: var(--Red, #eb455f);
	height: 15px;
}

.div-82 {
	background-color: rgba(0, 0, 0, 0.5);
	height: 82px;
}

.div-83 {
	border-radius: 29px;
	background-color: var(--Red, #eb455f);
	height: 15px;
}

.div-84 {
	display: flex;
	flex-grow: 1;
	flex-basis: 0%;
	flex-direction: column;
	font-size: 20px;
	color: var(--Navy-Blue, #2b3467);
	font-weight: 500;
}

.div-85 {
	color: rgba(0, 0, 0, 0.7);
	font-family: Inter, sans-serif;
}

.div-86 {
	margin-top: 17px;
	font: 300 18px Inter, sans-serif;
}

.div-87 {
	color: rgba(0, 0, 0, 0.8);
	font-family: Inter, sans-serif;
	margin-top: 49px;
}

@media (max-width: 991px) {
	.div-87 {
		margin-top: 40px;
	}
}

.div-88 {
	margin-top: 17px;
	font: 300 18px Inter, sans-serif;
}

.div-89 {
	color: rgba(0, 0, 0, 0.8);
	font-family: Inter, sans-serif;
	margin-top: 47px;
	white-space: nowrap;
}

@media (max-width: 991px) {
	.div-89 {
		margin-top: 40px;
		white-space: initial;
	}
}

.div-90 {
	margin-top: 17px;
	font: 300 18px Inter, sans-serif;
}

.div-91 {
	color: rgba(0, 0, 0, 0.8);
	font-family: Inter, sans-serif;
	margin-top: 54px;
	white-space: nowrap;
}

@media (max-width: 991px) {
	.div-91 {
		margin-top: 40px;
		white-space: initial;
	}
}
</style>