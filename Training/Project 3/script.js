let numQuestions = 0;
let numRight = 0;
let numWrong = 0;
let percentRight = 0;
let arrayNums = []

function newGame() {
    updateTable();
    createProblem();
}

function newProblem() {
    let userGuess = document.getElementById("user_guess").value = "";
    numQuestions ++;
    updateTable();
    createProblem();
}

function guessNum() {
    let userGuess = document.getElementById("user_guess").value;
    let correctGuess = false;
    for (let i = 0; i < arrayNums.length; i++) {
        if (userGuess == arrayNums[i]) {
            correctGuess = true;
        }
    }
    if (correctGuess == true) {
        numRight++;
        newProblem();
    } else {
        numWrong++;
        newProblem();
    }
}

function createProblem() {
    arrayNums = [];
    let randomNumber = Math.floor(Math.random()*10);
    while (randomNumber == 0) {
        randomNumber = Math.floor(Math.random()*10);
    }
    let initNumber = Math.floor(Math.random()*10);
    let blankNumber = Math.floor(Math.random() * (4 - 0 + 1)) + 0;
    for(let i = 0; i < 5; i++) {
        arrayNums[i] = initNumber;
        if (i == blankNumber) {
            document.getElementById("num_" + i).innerHTML = "_";
        } else {
            document.getElementById("num_" + i).innerHTML = initNumber;
        }
        initNumber += randomNumber;
    }
}

function updateTable() {
    document.getElementById("Question_Number").innerHTML = numQuestions;
    document.getElementById("Right").innerHTML = numRight;
    document.getElementById("Wrong").innerHTML = numWrong;
    if (numQuestions == 0) {
        percentRight = 0;
    } else {
        percentRight = (numRight / numQuestions) * 100;
    }
    document.getElementById("Percent_Right").innerHTML = Math.trunc(percentRight) + "%";
}

function inputKeyUp(e) {
    if (e.key === "Enter") {
        e.preventDefault();
        guessNum();
    }
}