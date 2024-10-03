const gameBoard = document.getElementById('game-board');
const rows = 8;
const cols = 8;
let turn = 'black'; // Começa com o jogador preto

// Inicializar o tabuleiro
function initializeBoard() {
    gameBoard.innerHTML = '';
    for (let i = 0; i < rows; i++) {
        const row = document.createElement('div');
        row.classList.add('row');

        for (let j = 0; j < cols; j++) {
            const cell = document.createElement('div');
            cell.classList.add('cell');

            if ((i + j) % 2 === 1) {
                cell.classList.add('playable');

                // Colocar peças
                if (i < 3) {
                    const piece = document.createElement('div');
                    piece.classList.add('piece', 'black');
                    cell.appendChild(piece);
                } else if (i > 4) {
                    const piece = document.createElement('div');
                    piece.classList.add('piece', 'white');
                    cell.appendChild(piece);
                }
            }
            row.appendChild(cell);
        }
        gameBoard.appendChild(row);
    }
}

// Mover peça (função básica)
function movePiece(event) {
    const piece = event.target;
    const parent = piece.parentElement;

    if (piece.classList.contains(turn)) {
        // Selecione a peça para mover (implementar lógica de movimentação)
        console.log('Moving', turn, 'piece');
    } else {
        console.log("It's not your turn!");
    }
}

initializeBoard();
