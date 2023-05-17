$(document).ready(function() {
    $("#loginbox").hide();
    $("#registerForm").hide();
    $("#login").click(function (e) { 
        e.preventDefault();
        $("#loginbox").show();
        $("#registerForm").hide();
        $("#loginForm").show();
    });

    $("#toRegister").click(function (e) { 
        e.preventDefault();
        $("#loginForm").hide();
        $("#registerForm").show();
    });

    $("#toLogin").click(function (e) { 
        e.preventDefault();
        $("#registerForm").hide();
        $("#loginForm").show();
    });

    $("#closeLogin").click(function (e) { 
        e.preventDefault();
        $("#loginbox").hide();
        $("#registerForm").hide();
        $("#loginForm").hide();  
    });

    $("#closeRegister").click(function (e) { 
        e.preventDefault();
        $("#loginbox").hide();
        $("#registerForm").hide();
        $("#loginForm").hide();  
    });
});

const daysTag = document.querySelector(".days"),
currentDate = document.querySelector(".current-date"),
prevNextIcon = document.querySelectorAll("header span");

let date = new Date(),
currYear = date.getFullYear(),
currMonth = date.getMonth();

const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "Novemeber", "December"];

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
        let isToday = i === date.getDate() && currMonth === new Date().getMonth() && currYear === new Date().getFullYear() ? "active" : "";
        liTag += `<li><p class="${isToday}">${i}</p></li>`;
    }

    for (let i = lastDayOfMonth; i < 6; i++) {
        liTag += `<li class="inactive"><p>${i - lastDayOfMonth + 1}</p></li>`;
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`;
    daysTag.innerHTML = liTag;
}

renderCalendar();

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
