xTurn = true;
gameOver = false;
xWin = false;

function nextTurn() {
    if (!gameOver) {
        if (xTurn) {
            document.querySelectorAll('.Piece_O').forEach(o => {
                o.setAttribute('draggable', false);
                o.style.cursor = 'default';
            });
            document.querySelectorAll('.Piece_X').forEach(x => {
                x.setAttribute('draggable', true);
                x.style.cursor = 'grab';
            });
            let turnIndicator = document.getElementById('turnIndicator');
            turnIndicator.innerHTML = "X Turn";
            turnIndicator.style.color = "red";
        } else {
            document.querySelectorAll('.Piece_O').forEach(o => {
                o.setAttribute('draggable', true);
                o.style.cursor = 'grab';
            });
            document.querySelectorAll('.Piece_X').forEach(x => {
                x.setAttribute('draggable', false);
                x.style.cursor = 'default';
            });
            let turnIndicator = document.getElementById('turnIndicator');
            turnIndicator.innerHTML = "O Turn";
            turnIndicator.style.color = "blue";
        }
        const gameBoard = document.querySelector('#game_board');
        gameBoard.querySelectorAll('.Game_Piece').forEach(piece => {
            piece.style.cursor = 'default';
            piece.setAttribute('draggable', false);
        })
    } else {
        if (xWin) {
            window.alert(["X Wins!"]);
        } else {
            window.alert(["O Wins!"]);
        }
    }
};

function checkWin() {
    const gameBoard = document.querySelector('#game_board');
    gameBoard.querySelectorAll('tr').forEach(row => {
        row.querySelectorAll('td').forEach(cell => {

        });
    });
}

const drag = event => {
    event.dataTransfer.setData('text/html', event.currentTarget.outerHTML);
    event.dataTransfer.setData('text/plain', event.currentTarget.dataset.id);
};

const dragStart = event => {
    event.currentTarget.classList.add('Drag_Piece');
};

const dragEnd = event => {
    event.currentTarget.classList.remove('Drag_Piece');
};

const dragEnter = event => {
    event.currentTarget.classList.add('Drop_Piece');
};

const dragLeave = event => {
    event.currentTarget.classList.remove('Drop_Piece');
};

document.querySelectorAll('.box').forEach(box => {
    box.addEventListener('dragenter', dragEnter);
    box.addEventListener('dragleave', dragLeave);
});

document.querySelectorAll('.Game_Piece').forEach(piece => {
    piece.addEventListener('dragstart', dragStart);
    piece.addEventListener('dragend', dragEnd);
});

const drop = event => {
    document.querySelectorAll('.box').forEach(box => box.classList.remove('Drop_Piece'));
    document.querySelectorAll('.box').forEach(box => box.classList.remove('Game_Piece'));
    let item = document.querySelector(`[data-id="${event.dataTransfer.getData('text/plain')}"]`);
    item.remove();

    event.currentTarget.innerHTML = event.currentTarget.innerHTML + event.dataTransfer.getData('text/html');
    event.currentTarget.removeAttribute('ondrop');
    event.currentTarget.removeAttribute('ondragover');
    item = document.querySelector(`[data-id="${event.dataTransfer.getData('text/plain')}"]`);
    item.removeAttribute('draggable');
    
    xTurn = !xTurn;
    checkWin();
    nextTurn();
};

const allowDrop = event => {
    event.preventDefault();
};

function newGame() {
    location.reload();
};

