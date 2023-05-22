var holidays = [];

class Holiday {
    constructor(id, title, date) {
        this.id = id;
        this.title = title;
        this.date = date;
    }
}

$(document).ready(function() {
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

    $.ajax({
        url: 'getHolidays.php',
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            for (let i = 0; i < data.length; i++) {
                holidays.push(new Holiday(data[i].id, data[i].title, data[i].date));
            }
            console.log(holidays);
            renderCalendar();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error: ' + textStatus + ' - ' + errorThrown);
        }
    });
});

const daysTag = document.querySelector(".days"),
currentDate = document.querySelector(".current-date"),
prevNextIcon = document.querySelectorAll("header span");

let date = new Date(),
currYear = date.getFullYear(),
currMonth = date.getMonth();

const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

const renderCalendar = () => {
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
        for (let j = 0; j < holidays.length; j++) {
            let SQLDate = holidays[j].date;
            let adate = SQLDate.replace(/ [-]/g, '/');
            adate = Date.parse(adate);
            let jsDate = new Date(adate);
            if(jsDate.getDate() === i && jsDate.getMonth() === currMonth) {
                holiday = `<div class="holiday">${holidays[j].title}</div>`;
                break
            } else {
                holiday = "";
            }
        }
        let isToday = i === date.getDate() && currMonth === new Date().getMonth() && currYear === new Date().getFullYear() ? "active" : "";
        liTag += `<li><p class="${isToday}">${i}</p><div class="events-holder">${holiday}</div></li>`;
    }

    for (let i = lastDayOfMonth; i < 6; i++) {
        liTag += `<li class="inactive"><p>${i - lastDayOfMonth + 1}</p></li>`;
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`;
    daysTag.innerHTML = liTag;
}

prevNextIcon.forEach(icon => {
    icon.addEventListener("click", () => {
        currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

        if (currMonth < 0 || currMonth > 11) {
            date = new DataTransfer(currYear, currMonth, new Date().getDate());
            currYear = date.getFullYear();
            currMonth = date.getMonth();
        } else {
            date = new Date();
        }
        renderCalendar();
    });
});