var board;
//var posiciones = [];
  var game = new Chess();
  var pos = 0;
function main(){
  //guardo la pos inicial
  //posiciones.push(game.fen());
  //primero inicio el tablero
  board = Chessboard('myBoard', {
    draggable: true,
    moveSpeed: 'slow',
    snapbackSpeed: 500,
    snapSpeed: 100,
    position: 'start',
    onDragStart: onDragStart,
    onDrop: onDrop,
    onSnapEnd: onSnapEnd
    })
      
    updateStatus();

    let reiniciar = document.getElementById("reiniciar");
    reiniciar.addEventListener("click", reinciarBoard, false);
    let deshacer = document.getElementById("deshacer");
    deshacer.addEventListener("click", deshacerJugada, false);
    let submit = document.getElementById("submit");
    submit.addEventListener("click", alertar, false);
}

function deshacerJugada(evento){
  if(pos>0){
    //primero decremento pos
    pos--;
    //cargo en la partida y el tablero las posiciones
    //game.load(posiciones[pos]);
    game.undo();
    //board.position(posiciones[pos].split(" ")[0]);
    board.position(game.fen());
    //borro el último elemento del elemento
    //posiciones.pop();
    //actualizo las jugadas
    let pgn_aux = document.getElementById("mov");
    pgn_aux.value=game.pgn();
  }
  else{
    alert("Es la primera jugada, no puedes retroceder más");
  }
}

function alertar(evento){
    let mov = document.getElementById("mov");
    if(mov.value==""){
      alert("No se podrá guardar la partida, no hay jugadas!");
    }
}

function reinciarBoard(evento){
    game.reset();
    board.position("start");
    let pgn_aux = document.getElementById("mov");
    pgn_aux.value=game.pgn();
}

document.addEventListener("DOMContentLoaded",main, false);

//movimientos legales
// NOTE: this example uses the chess.js library:
// https://github.com/jhlywa/chess.js

function onDragStart (source, piece, position, orientation) {
  // do not pick up pieces if the game is over
  if (game.game_over()) return false

  // only pick up pieces for the side to move
  if ((game.turn() === 'w' && piece.search(/^b/) !== -1) ||
      (game.turn() === 'b' && piece.search(/^w/) !== -1)) {
    return false
  }
}

function onDrop (source, target) {
  // see if the move is legal
  var move = game.move({
    from: source,
    to: target,
    promotion: 'q' // NOTE: always promote to a queen for example simplicity
  })

  // illegal move
  if (move === null) return 'snapback'

  updateStatus()
  let pgn_aux = document.getElementById("mov");
  pgn_aux.value=game.pgn();
  //almaceno en el array incremento la pos
  //posiciones.push(game.fen());
  pos++;
}

// update the board position after the piece snap
// for castling, en passant, pawn promotion
function onSnapEnd () {
  board.position(game.fen())
}

function updateStatus () {
  var status = ''

  var moveColor = 'White'
  if (game.turn() === 'b') {
    moveColor = 'Black'
  }

  // checkmate?
  if (game.in_checkmate()) {
    status = 'Game over, ' + moveColor + ' is in checkmate.'
  }

  // draw?
  else if (game.in_draw()) {
    status = 'Game over, drawn position'
  }

  // game still on
  else {
    status = moveColor + ' to move'

    // check?
    if (game.in_check()) {
      status += ', ' + moveColor + ' is in check'
    }
  }
}

