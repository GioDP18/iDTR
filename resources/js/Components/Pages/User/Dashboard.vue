<script setup>
import { ref, onMounted } from 'vue';

const activeTime = ref("");
const currentDate = ref("");
const greeting = ref("");

const updateDateTime = () => {
    const now = new Date();

    let hours = now.getHours();
    const minutes = now.getMinutes().toString().padStart(2, "0");
    const meridiem = hours >= 12 ? "PM" : "AM";
    hours = hours % 12 || 12;
    activeTime.value = `${hours}:${minutes} ${meridiem}`;
    console.log(hours + meridiem);
    

    if (meridiem == "AM" && hours >= 1 && hours <= 12) {
        greeting.value = "Morning"
    }
    else if (meridiem == "PM" && hours >= 1) {
        greeting.value = "Afternoon";
    }
    else if (meridiem == "PM" && hours >= 6) {
        greeting.value = "Evening";
    }

    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    currentDate.value = now.toLocaleDateString(undefined, options);
};

onMounted(() => {
    updateDateTime();
    setInterval(updateDateTime, 1000);
});
import $ from 'jquery';

$(document).ready(function () {
    function c(passed_month, passed_year, calNum) {
        var calendar = calNum == 0 ? calendars.cal1 : calendars.cal2;
        makeWeek(calendar.weekline);
        calendar.datesBody.empty();
        var calMonthArray = makeMonthArray(passed_month, passed_year);
        var r = 0;
        var u = false;
        while (!u) {
            if (daysArray[r] == calMonthArray[0].weekday) {
                u = true
            } else {
                calendar.datesBody.append('<div class="blank"></div>');
                r++;
            }
        }
        for (var cell = 0; cell < 42 - r; cell++) { // 42 date-cells in calendar
            if (cell >= calMonthArray.length) {
                calendar.datesBody.append('<div class="blank"></div>');
            } else {
                var shownDate = calMonthArray[cell].day;
                var iter_date = new Date(passed_year, passed_month, shownDate);
                if (
                    (
                        (shownDate != today.getDate() && passed_month == today.getMonth()) || passed_month != today.getMonth()) && iter_date < today) {
                    var m = '<div class="past-date">';
                } else {
                    var m = checkToday(iter_date) ? '<div class="today">' : "<div>";
                }
                calendar.datesBody.append(m + shownDate + "</div>");
            }
        }

        var color = "#848884";
        calendar.calHeader.find("h2").text(i[passed_month] + " " + passed_year);
        calendar.calHeader.find("h2").css("font-size", "20px");
        calendar.weekline.find("div").css("color", color);
        calendar.datesBody.find(".today").css("color", "white");
        calendar.datesBody.find(".today").css("background-color", "#EB455F");
        calendar.datesBody.find(".today").css("border-radius", "50%");

        // find elements (dates) to be clicked on each time
        // the calendar is generated
        var clicked = false;
        selectDates(selected);

        clickedElement = calendar.datesBody.find('div');
        clickedElement.on("click", function () {
            clicked = $(this);
            var whichCalendar = calendar.name;

            if (firstClick && secondClick) {
                thirdClicked = getClickedInfo(clicked, calendar);
                var firstClickDateObj = new Date(firstClicked.year,
                    firstClicked.month,
                    firstClicked.date);
                var secondClickDateObj = new Date(secondClicked.year,
                    secondClicked.month,
                    secondClicked.date);
                var thirdClickDateObj = new Date(thirdClicked.year,
                    thirdClicked.month,
                    thirdClicked.date);
                if (secondClickDateObj > thirdClickDateObj && thirdClickDateObj > firstClickDateObj) {
                    secondClicked = thirdClicked;
                    // then choose dates again from the start :)
                    bothCals.find(".calendar_content").find("div").each(function () {
                        $(this).removeClass("selected");
                    });
                    selected = {};
                    selected[firstClicked.year] = {};
                    selected[firstClicked.year][firstClicked.month] = [firstClicked.date];
                    selected = addChosenDates(firstClicked, secondClicked, selected);
                } else { // reset clicks
                    selected = {};
                    firstClicked = [];
                    secondClicked = [];
                    firstClick = false;
                    secondClick = false;
                    bothCals.find(".calendar_content").find("div").each(function () {
                        $(this).removeClass("selected");
                    });
                }
            }
            if (!firstClick) {
                firstClick = true;
                firstClicked = getClickedInfo(clicked, calendar);
                selected[firstClicked.year] = {};
                selected[firstClicked.year][firstClicked.month] = [firstClicked.date];
            } else {
                secondClick = true;
                secondClicked = getClickedInfo(clicked, calendar);

                // what if second clicked date is before the first clicked?
                var firstClickDateObj = new Date(firstClicked.year,
                    firstClicked.month,
                    firstClicked.date);
                var secondClickDateObj = new Date(secondClicked.year,
                    secondClicked.month,
                    secondClicked.date);

                if (firstClickDateObj > secondClickDateObj) {

                    var cachedClickedInfo = secondClicked;
                    secondClicked = firstClicked;
                    firstClicked = cachedClickedInfo;
                    selected = {};
                    selected[firstClicked.year] = {};
                    selected[firstClicked.year][firstClicked.month] = [firstClicked.date];

                } else if (firstClickDateObj.getTime() == secondClickDateObj.getTime()) {
                    selected = {};
                    firstClicked = [];
                    secondClicked = [];
                    firstClick = false;
                    secondClick = false;
                    $(this).removeClass("selected");
                }


                // add between dates to [selected]
                selected = addChosenDates(firstClicked, secondClicked, selected);
            }
            selectDates(selected);
        });
    }

    function selectDates(selected) {
        if (!$.isEmptyObject(selected)) {
            var dateElements1 = datesBody1.find('div');
            var dateElements2 = datesBody2.find('div');

            function highlightDates(passed_year, passed_month, dateElements) {
                if (passed_year in selected && passed_month in selected[passed_year]) {
                    var daysToCompare = selected[passed_year][passed_month];
                    for (var d in daysToCompare) {
                        dateElements.each(function (index) {
                            if (parseInt($(this).text()) == daysToCompare[d]) {
                                $(this).addClass('selected');
                            }
                        });
                    }

                }
            }

            highlightDates(year, month, dateElements1);
            highlightDates(nextYear, nextMonth, dateElements2);
        }
    }

    function makeMonthArray(passed_month, passed_year) { // creates Array specifying dates and weekdays
        var e = [];
        for (var r = 1; r < getDaysInMonth(passed_year, passed_month) + 1; r++) {
            e.push({
                day: r,
                // Later refactor -- weekday needed only for first week
                weekday: daysArray[getWeekdayNum(passed_year, passed_month, r)]
            });
        }
        return e;
    }

    function makeWeek(week) {
        week.empty();
        for (var e = 0; e < 7; e++) {
            week.append("<div>" + daysArray[e].substring(0, 3) + "</div>")
        }
    }

    function getDaysInMonth(currentYear, currentMon) {
        return (new Date(currentYear, currentMon + 1, 0)).getDate();
    }

    function getWeekdayNum(e, t, n) {
        return (new Date(e, t, n)).getDay();
    }

    function checkToday(e) {
        var todayDate = today.getFullYear() + '/' + (today.getMonth() + 1) + '/' + today.getDate();
        var checkingDate = e.getFullYear() + '/' + (e.getMonth() + 1) + '/' + e.getDate();
        return todayDate == checkingDate;

    }

    function getAdjacentMonth(curr_month, curr_year, direction) {
        var theNextMonth;
        var theNextYear;
        if (direction == "next") {
            theNextMonth = (curr_month + 1) % 12;
            theNextYear = (curr_month == 11) ? curr_year + 1 : curr_year;
        } else {
            theNextMonth = (curr_month == 0) ? 11 : curr_month - 1;
            theNextYear = (curr_month == 0) ? curr_year - 1 : curr_year;
        }
        return [theNextMonth, theNextYear];
    }

    function b() {
        today = new Date;
        year = today.getFullYear();
        month = today.getMonth();
        var nextDates = getAdjacentMonth(month, year, "next");
        nextMonth = nextDates[0];
        nextYear = nextDates[1];
    }

    var e = 480;

    var today;
    var year,
        month,
        nextMonth,
        nextYear;

    var r = [];
    var i = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"];
    var daysArray = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday"];

    var cal1 = $("#calendar_first");
    var calHeader1 = cal1.find(".calendar_header");
    var weekline1 = cal1.find(".calendar_weekdays");
    var datesBody1 = cal1.find(".calendar_content");

    var cal2 = $("#calendar_second");
    var calHeader2 = cal2.find(".calendar_header");
    var weekline2 = cal2.find(".calendar_weekdays");
    var datesBody2 = cal2.find(".calendar_content");

    var bothCals = $(".calendar");

    var switchButton = bothCals.find(".calendar_header").find('.switch-month');

    var calendars = {
        "cal1": {
            "name": "first",
            "calHeader": calHeader1,
            "weekline": weekline1,
            "datesBody": datesBody1
        },
        "cal2": {
            "name": "second",
            "calHeader": calHeader2,
            "weekline": weekline2,
            "datesBody": datesBody2
        }
    }

    var clickedElement;
    var firstClicked,
        secondClicked,
        thirdClicked;
    var firstClick = false;
    var secondClick = false;
    var selected = {};

    b();
    c(month, year, 0);
    c(nextMonth, nextYear, 1);
    switchButton.on("click", function () {
        var clicked = $(this);
        var generateCalendars = function (e) {
            var nextDatesFirst = getAdjacentMonth(month, year, e);
            var nextDatesSecond = getAdjacentMonth(nextMonth, nextYear, e);
            month = nextDatesFirst[0];
            year = nextDatesFirst[1];
            nextMonth = nextDatesSecond[0];
            nextYear = nextDatesSecond[1];

            c(month, year, 0);
            c(nextMonth, nextYear, 1);
        };
        if (clicked.attr("class").indexOf("left") != -1) {
            generateCalendars("previous");
        } else {
            generateCalendars("next");
        }
        clickedElement = bothCals.find(".calendar_content").find("div");
    });


    //  Click picking stuff
    function getClickedInfo(element, calendar) {
        var clickedInfo = {};
        var clickedCalendar,
            clickedMonth,
            clickedYear;
        clickedCalendar = calendar.name;
        clickedMonth = clickedCalendar == "first" ? month : nextMonth;
        clickedYear = clickedCalendar == "first" ? year : nextYear;
        clickedInfo = {
            "calNum": clickedCalendar,
            "date": parseInt(element.text()),
            "month": clickedMonth,
            "year": clickedYear
        }
        return clickedInfo;
    }


    // Finding between dates MADNESS. Needs refactoring and smartening up :)
    function addChosenDates(firstClicked, secondClicked, selected) {
        if (secondClicked.date > firstClicked.date || secondClicked.month > firstClicked.month || secondClicked.year > firstClicked.year) {

            var added_year = secondClicked.year;
            var added_month = secondClicked.month;
            var added_date = secondClicked.date;

            if (added_year > firstClicked.year) {
                // first add all dates from all months of Second-Clicked-Year
                selected[added_year] = {};
                selected[added_year][added_month] = [];
                for (var i = 1;
                    i <= secondClicked.date;
                    i++) {
                    selected[added_year][added_month].push(i);
                }

                added_month = added_month - 1;
                while (added_month >= 0) {
                    selected[added_year][added_month] = [];
                    for (var i = 1;
                        i <= getDaysInMonth(added_year, added_month);
                        i++) {
                        selected[added_year][added_month].push(i);
                    }
                    added_month = added_month - 1;
                }

                added_year = added_year - 1;
                added_month = 11; // reset month to Dec because we decreased year
                added_date = getDaysInMonth(added_year, added_month); // reset date as well

                // Now add all dates from all months of inbetween years
                while (added_year > firstClicked.year) {
                    selected[added_year] = {};
                    for (var i = 0; i < 12; i++) {
                        selected[added_year][i] = [];
                        for (var d = 1; d <= getDaysInMonth(added_year, i); d++) {
                            selected[added_year][i].push(d);
                        }
                    }
                    added_year = added_year - 1;
                }
            }

            if (added_month > firstClicked.month) {
                if (firstClicked.year == secondClicked.year) {
                    selected[added_year][added_month] = [];
                    for (var i = 1;
                        i <= secondClicked.date;
                        i++) {
                        selected[added_year][added_month].push(i);
                    }
                    added_month = added_month - 1;
                }
                while (added_month > firstClicked.month) {
                    selected[added_year][added_month] = [];
                    for (var i = 1;
                        i <= getDaysInMonth(added_year, added_month);
                        i++) {
                        selected[added_year][added_month].push(i);
                    }
                    added_month = added_month - 1;
                }
                added_date = getDaysInMonth(added_year, added_month);
            }

            for (var i = firstClicked.date + 1;
                i <= added_date;
                i++) {
                selected[added_year][added_month].push(i);
            }
        }
        return selected;
    }
});

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
                                                    <div class="greeting-text">Good {{ greeting }}, Gio</div>
                                                    <div class="date-text">{{ currentDate }}</div>
                                                    <div class="time-text sticky-top">{{ activeTime }}</div>
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
                                    <div class="calendar calendar-first" id="calendar_first">
                                        <div class="calendar_header">
                                            <button class="switch-month switch-left">
                                                <i><font-awesome-icon :icon="['fas', 'less-than']" /></i>
                                            </button>
                                            <h2></h2>
                                            <button class="switch-month switch-right">
                                                <i><font-awesome-icon :icon="['fas', 'greater-than']" /></i>
                                            </button>
                                        </div>
                                        <div class="calendar_weekdays" data-background-color="blue2"></div>
                                        <div class="calendar_content"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="div-69">
                        <div class="div-70">Status</div>
                        <div class="div-71">Activity Logs</div>
                    </div>
                    <div class="div-72">
                        <div class="div-73">
                            <div class="activity-card">
                                <div class="div-74">
                                    <div class="d-flex" style="align-items:center; margin-left:4.5rem;">
                                        <!-- <p style="width:2rem; height:1rem; background-color:#ef2121;"></p> -->
                                        <p style="width:2rem; height:1rem; background-color:#00ba00;"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="activity-card">
                                <div class="div-74">
                                    <div class="tl-item active">
                                        <div class="tl-dot b-warning"></div>
                                        <div class="tl-content">
                                            <div class="" style="font-size: 15px;">Time in - <span
                                                    style="font-weight: bold; color: rgb(90, 88, 88);">Gio O. Dela
                                                    Pena</span>
                                            </div>
                                            <div class="tl-date text-muted mt-1">
                                                <span>02/05/23</span>
                                                <span>10:00 am</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tl-item">
                                        <div class="tl-dot b-primary"></div>
                                        <div class="tl-content">
                                            <div class="" style="font-size: 15px;">Time out - <span
                                                    style="font-weight: bold; color: rgb(90, 88, 88);">Gio O. Dela
                                                    Pena</span>
                                            </div>
                                            <div class="tl-date text-muted mt-1">
                                                <span>02/05/23</span>
                                                <span>10:00 am</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tl-item">
                                        <div class="tl-dot b-danger"></div>
                                        <div class="tl-content">
                                            <div class="" style="font-size: 15px;">Time out - <span
                                                    style="font-weight: bold; color: rgb(90, 88, 88);">Christian Kit V.
                                                    Rotairo</span>
                                            </div>
                                            <div class="tl-date text-muted mt-1">
                                                <span>02/05/23</span>
                                                <span>10:00 am</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tl-item">
                                        <div class="tl-dot b-warning"></div>
                                        <div class="tl-content">
                                            <div class="" style="font-size: 15px;">Time out - <span
                                                    style="font-weight: bold; color: rgb(90, 88, 88);">Christian Kit V.
                                                    Rotairo</span>
                                            </div>
                                            <div class="tl-date text-muted mt-1">
                                                <span>02/05/23</span>
                                                <span>10:00 am</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tl-item">
                                        <div class="tl-dot b-danger"></div>
                                        <div class="tl-content">
                                            <div class="" style="font-size: 15px;">Time out - <span
                                                    style="font-weight: bold; color: rgb(90, 88, 88);">Jhon Vincent
                                                    Ramada</span>
                                            </div>
                                            <div class="tl-date text-muted mt-1">
                                                <span>02/05/23</span>
                                                <span>10:00 am</span>
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
        <footer class="footer">
            <div class="container-fluid">
            </div>
        </footer>
    </div>
</template>

<style scoped>
.tl-item {
    border-radius: 3px;
    position: relative;
    display: -ms-flexbox;
    display: flex
}

.tl-item>* {
    padding: 10px
}

.tl-item:last-child .tl-dot:after {
    display: none
}

.tl-item.active .tl-dot:before {
    border-color: #ec0000;
    box-shadow: 0 0 0 4px rgba(255, 68, 68, 0.2)
}

.tl-item:last-child .tl-dot:after {
    display: none
}

.tl-item.active .tl-dot:before {
    border-color: #ec0000;
    box-shadow: 0 0 0 4px rgba(255, 68, 68, 0.2)
}

.tl-dot {
    position: relative;
    border-color: #ec0000;
}

.tl-dot:after,
.tl-dot:before {
    content: '';
    position: absolute;
    border-color: inherit;
    border-width: 2px;
    border-style: solid;
    border-radius: 50%;
    width: 10px;
    height: 10px;
    top: 15px;
    left: 50%;
    transform: translateX(-50%)
}

.tl-dot:after {
    width: 0;
    height: auto;
    top: 25px;
    bottom: -15px;
    border-right-width: 0;
    border-top-width: 0;
    border-bottom-width: 0;
    border-radius: 0
}


.tl-dot:after {
    width: 0;
    height: auto;
    top: 25px;
    bottom: -15px;
    border-right-width: 0;
    border-top-width: 0;
    border-bottom-width: 0;
    border-radius: 0
}

.tl-content p:last-child {
    margin-bottom: 0
}

.tl-date {
    font-size: .85em;
    margin-top: 2px;
    min-width: 150px;
    max-width: 150px;
}

.b-warning {
    border-color: #727272 !important;
}

.b-primary {
    border-color: #ec0000;
}

.b-danger {
    border-color: #f54394 !important;
}

.div-2 {
    width: 100%;
}

@media (max-width: 991px) {
    .div-2 {
        max-width: 100%;
        margin-top: 40px;
    }
}

@media (max-width: 991px) {
    .img {
        margin-left: 25px;
        width: 170px;
        height: 170px;
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

.div-74{
    overflow: hidden;
}

.div-74:hover{
    overflow-y: auto;
    cursor: pointer;
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
}

@media (max-width: 991px) {
    .column-6 {
        width: 100%;
        flex-wrap: wrap;
        margin-top: 40px;
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
    padding: 30px;
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

.calendar {
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
}

/* Styling for the calendar header */
.calendar_header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
}

/* Styling for the month switch buttons */
.switch-month {
    color: #B2BEB5;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    background-color: transparent;
}

.switch-month:hover {
    color: #6082B6;
}

/* Styling for the calendar weekdays row */
.calendar_weekdays {
    display: flex;
    justify-content: space-between;
    padding: 10px;
    margin-bottom: 10px;
}

/* Styling for each day in the weekdays row */
.calendar_weekdays div {
    flex: 1;
    text-align: center;
}

/* Styling for the calendar content (dates) */
.calendar_content {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 10px;
}

/* Styling for each date cell */
.calendar_content div {
    text-align: center;
    padding: 10px;
    border: 1px solid #ccc;
    cursor: pointer;
}

/* Styling for today's date */
.calendar_content .today {
    background-color: #00bdaa;
    color: #fff;
    font-weight: bold;
}

/* Styling for selected date range */
.calendar_content .selected {
    background-color: #3498db;
    color: #fff;
    font-weight: bold;
}

/* Styling for past dates */
.calendar_content .past-date {
    color: #999;
}

/* Styling for blank date cells */
.calendar_content .blank {
    visibility: hidden;
}</style>