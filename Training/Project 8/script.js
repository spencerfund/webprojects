var holidays = [];
var appointments = [];

class Holiday {
    constructor(id, title, date) {
        this.id = id;
        this.title = title;
        this.date = date;
    }
}

class Appointment {
    constructor(id, title, startDate, endDate) {
        this.id = id;
        this.title = title;
        this.startDate = startDate;
        this.endDate = endDate;
    }
}

$(document).ready(function() {
    let username = $("#storage").attr("data-username");

    $("#loginbox").hide();
    $("#registerForm").hide();
    $("#login").click(function (e) { 
        e.preventDefault();
        $("#loginbox").css("display", "flex");
        $("#registerForm").hide();
        $("#loginForm").css("display", "flex");
    });

    $("#toRegister").click(function (e) { 
        e.preventDefault();
        $("#loginForm").hide();
        $("#registerForm").css("display", "flex");
    });

    $("#toLogin").click(function (e) { 
        e.preventDefault();
        $("#registerForm").hide();
        $("#loginForm").css("display", "flex");
    });

    $("#closeLogin").click(function (e) { 
        e.preventDefault();
        $("#loginbox").hide();
        $("#registerForm").hide();
        $("#loginForm").hide();  
        $("#logout-confirm").hide();
    });

    $("#closeRegister").click(function (e) { 
        e.preventDefault();
        $("#loginbox").hide();
        $("#registerForm").hide();
        $("#loginForm").hide();  
        $("#logout-confirm").hide();
    });

    $("#closeLogout").click(function (e) { 
        e.preventDefault();
        $("#loginbox").hide();
        $("#registerForm").hide();
        $("#loginForm").hide();  
        $("#logout-confirm").hide();
    });

    $("#closeNewEvent").click(function (e) { 
        e.preventDefault();
        $("#newAppointmentBox").hide();
        $("#newAppointmentForm").hide();
    });


    $("#newEvent").click(function (e) { 
        e.preventDefault();
        $("#newAppointmentBox").css("display", "flex");
        $("#newAppointmentForm").css("display", "flex");
    });

    $("#eventBtn").click(function (e) { 
        e.preventDefault();
        $.ajax({
            url: 'addEvent.php',
            type: 'POST',
            data: {
                title: $("#title").val(),
                date: $("#date").val(),
                startTime: $("#start-time").val(),
                endTime: $("#end-time").val()
            },
            dataType: 'json',
            success: function() {
                $("#newAppointmentBox").hide();
                $("#newAppointmentForm").hide();
                getEvents(username);
                renderCalendar();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('Error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });

    if (username != "") {
        getEvents(username);
    }
    getHolidays();
});

const daysTag = document.querySelector(".days"),
currentDate = document.querySelector(".current-date"),
prevNextIcon = document.querySelectorAll("header span");

let date = new Date(),
currYear = date.getFullYear(),
currMonth = date.getMonth();

const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

function getHolidays() {
    $.ajax({
        url: 'getHolidays.php',
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            for (let i = 0; i < data.length; i++) {
                holidays.push(new Holiday(data[i].id, data[i].title, data[i].date));
            }
            renderCalendar();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error: ' + jqXHR + textStatus + ' - ' + errorThrown);
        }
    });
}

function getEvents(username) {
    appointments = [];
    let startMonth = new Date(currYear, currMonth, 1, 0, 0, 0).toISOString().slice(0,19).replace('T', ' ');
    let endMonth = new Date(currYear, currMonth + 1, 0, 23, 59, 59).toISOString().slice(0,19).replace('T', ' ');
    $.ajax({
        url: 'getEvents.php',
        type: 'POST',
        data: {
            username: username,
            startMonth: startMonth,
            endMonth: endMonth
        },
        dataType: 'json',
        success: function(data) {
            for (let i = 0; i < data.length; i++) {
                appointments.push(new Appointment(data[i].id, data[i].title, data[i].startDate, data[i].endDate));
            }
            renderCalendar();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error: ' + textStatus + ' - ' + errorThrown);
        }
    });
}

const renderCalendar = () => {
    let username = $("#storage").attr("data-username");
    let firstDayOfMonth = new Date(currYear, currMonth, 1).getDay(),
    lastDateOfMonth = new Date(currYear, currMonth + 1, 0).getDate(),
    lastDayOfMonth = new Date(currYear, currMonth, lastDateOfMonth).getDay(),
    lastDateOfLastMonth = new Date(currYear, currMonth, 0).getDate();
    let liTag = "";

    for (let i = firstDayOfMonth; i > 0; i--) {
        liTag += `<li class="inactive"><p>${lastDateOfLastMonth - i + 1}</p></li>`;
    }

    for (let i = 1; i <= lastDateOfMonth; i++) {
        let holiday;
        let appointment = "";
        for (let j = 0; j < holidays.length; j++) {
            let SQLDate = holidays[j].date;
            let adate = SQLDate.replace(/ [-]/g, '/');
            adate = Date.parse(adate);
            let jsDate = new Date(adate);
            if(jsDate.getDate() === i && jsDate.getMonth() === currMonth) {
                holiday = `<div class="holiday">${holidays[j].title}</div>`;
                break;
            } else {
                holiday = "";
            }
        }
        for (let k = 0; k < appointments.length; k++) {
            let SQLStartDate = appointments[k].startDate;
            let SQLEndDate = appointments[k].endDate;
            let startDate = SQLStartDate.replace(/ [-] /g, '/');
            let endDate = SQLEndDate.replace(/ [-] /g, '/');
            let jsStartDate = new Date(startDate);
            let jsEndDate = new Date(endDate);
            let jsStartHour = jsStartDate.getHours();
            let jsStartMinute = jsStartDate.getMinutes().toString().padStart(2, '0');
            let jsEndHour = jsEndDate.getHours();
            let jsEndMinute = jsEndDate.getMinutes().toString().padStart(2, '0');
            if (jsStartDate.getDate() === i && jsStartDate.getMonth() === currMonth) {
                appointment += `<div class="appointment" id="app${i}" onclick="deleteApp(this.id)">${appointments[k].title}<br>${jsStartHour}:${jsStartMinute} - ${jsEndHour}:${jsEndMinute}</div>`;
            }
        }
        let isToday = i === date.getDate() && currMonth === new Date().getMonth() && currYear === new Date().getFullYear() ? "active" : "";
        liTag += `<li><p class="${isToday}">${i}</p><div class="events-holder">${holiday}${appointment}</div></li>`;
    }

    for (let i = lastDayOfMonth; i < 6; i++) {
        liTag += `<li class="inactive"><p>${i - lastDayOfMonth + 1}</p></li>`;
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`;
    daysTag.innerHTML = liTag;
}

prevNextIcon.forEach(icon => {
    let username = $("#storage").attr("data-username");
    icon.addEventListener("click", () => {
        currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

        if (currMonth < 0 || currMonth > 11) {
            date = new DataTransfer(currYear, currMonth, new Date().getDate());
            currYear = date.getFullYear();
            currMonth = date.getMonth();
        } else {
            date = new Date();
        }
        getEvents(username);
    });
});

function deleteApp(appID) {
    let username = $("#storage").attr("data-username");
    queryID = "#" + appID;
    let stuff = $(queryID).html();
    deleteTitle = stuff.substr(0, stuff.indexOf('<'));
    $.ajax({
        url: 'deleteEvent.php',
        type: 'POST',
        dataType: 'json',
        data: {
            title: deleteTitle
        },
        success: function() {
            getEvents(username);
            renderCalendar();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error: ' + textStatus + ' - ' + errorThrown);
        }
    });
}