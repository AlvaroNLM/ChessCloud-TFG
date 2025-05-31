var board,posiciones; 
  var chess = new Chess();
  var pos = 0;
  //https://www.freecodecamp.org/news/simple-chess-ai-step-by-step-1d55a9266977/
function main(){
    //primero inicio el tablero
    board = Chessboard('myBoard', {
        draggable: true,
        moveSpeed: 'slow',
        snapbackSpeed: 500,
        snapSpeed: 100,
        onChange: makeBestMove,
        onDrop: onDrop,
        dropOffBoard: 'trash',
        position: 'start'
    })
    //turno
    var turno = document.getElementById("turno");
    turno.textContent = chess.turn()=="w" ? "juegan blancas" : "juegan negras";
    //jugada (nº)
    var volverJugada = document.getElementById("volver");
    var n = Math.trunc(pos/2) + 1;  
    var dondeVuelvo = "Volver a la jugada " + n + " donde " + turno.textContent;
    volverJugada.textContent = dondeVuelvo;
    //ahora creo el array de posiciones para navegar de una a otra
    var jugadas = document.getElementById("movimientos-procesados").textContent;
    posiciones = transformaJugadas(jugadas);
    //ahora muestro sólo lo construido
    document.getElementById("movimientos").classList.add("invisible");
    //creo los listeners para cada jugada y de estas ir a su posición
    var div = document.getElementById("listeners");
    let spans = div.querySelectorAll("span");
    for(var i = 0; i < spans.length; i++){
        spans[i].addEventListener("click",cargarJugada, false);
    }
    //inicializo y enlazo los botones siguiente y anterior
    //next
    let next = document.getElementById("next");
    next.addEventListener("click",NextMovement, false);
    //before
    let before = document.getElementById("before");
    before.addEventListener("click",BeforeMovement, false);
    //volver
    let volver = document.getElementById("volver");
    volver.addEventListener("click",volverPos, false);
    //makeBestMove();
    let check = document.getElementById("IA");
    check.value="off";
    let span = document.getElementById("span");
    span.addEventListener("click",ActivarCheck, false);
    chess = new Chess();
}


var onDrop = function (source, target) {

    var move = chess.move({
        from: source,
        to: target,
        promotion: 'q'
    });
    board.position(chess.fen());//.split(" ")[0]);
    //board.position(chess.fen());

    if (move === null) {
        return 'snapback';
    }

    renderMoveHistory(chess.history());
    //window.setTimeout(makeBestMove, 250);
};

var onDragStart = function (source, piece, position, orientation) {
    if (chess.in_checkmate() === true || chess.in_draw() === true ||
        piece.search(/^b/) !== -1) {
        return false;
    }
};

function ActivarCheck(evento){
    let check = document.getElementById("IA");
    if(check.value=="on"){
        check.value="off";
    }
    else{
        check.value="on"
    }
    makeBestMove();
}

function transformaJugadas(jugadas){
  var array_jugadas = jugadas.split(",");
  var posicion_inicial = board.fen();
  var posiciones = new Array(posicion_inicial);
  var blancas, negras;
  var posicion_array = 1;
  var i = 1;
  var texto = "";
  for(let jugada of array_jugadas){
    //1.e4 e5
    //25.Qxe3+
    var partes = jugada.split(" ");
    //e4
    blancas = partes[0];
    texto+= "<span class=" + `"jugada"` + " id=" + `"${posicion_array}"` + " > " + i + ". " + blancas + "</span>";
    posicion_array++;
    if(blancas.includes("0")){
      if(blancas.length==3){
        chess.move("O-O");
      }
      else{
        chess.move("O-O-O");
      }
    } 
    else{ 
      chess.move(blancas);
    }
    posiciones.push(chess.fen());
    //e6
    if(partes.length>1){
      negras = partes[1];
      //negras = negras.replace(/0/g,"O");
      texto+= "<span class=" + `"jugada"` + " id=" + `"${posicion_array}"` + " > " + negras + "</span>";
      if(negras.includes("0")){
        if(negras.length==3){
          chess.move("O-O");
        }
        else{
          chess.move("O-O-O");
        }
      } 
      else{ 
        chess.move(negras);
      }
      //var aux = chess.move(negras);
      posiciones.push(chess.fen());
      posicion_array++;
    }
    i++;
  }
  //para crear las jugadas con sus listeners
  var div = document.getElementById("listeners"); 
  div.innerHTML = texto;
  //board.clear();
  return posiciones;
}

function NextMovement(evento){
    if(pos < posiciones.length) {
        chess.load(posiciones[++pos]);
        board.position(posiciones[pos].split(" ")[0]);
        //makeBestMove();
        //turno
        var turno = document.getElementById("turno");
        turno.textContent = chess.turn()=="w" ? "juegan blancas" : "juegan negras";
        //jugada (nº)
        var volverJugada = document.getElementById("volver");
        var n = Math.trunc(pos/2) + 1;  
        var dondeVuelvo = "Volver a la jugada " + n + " donde " + turno.textContent;
        volverJugada.textContent = dondeVuelvo;
    }
    else{
        alert("Es la última jugada, no puedes avanzar más.")
    }
}

function BeforeMovement(evento){
    if(pos > 0) {
        chess.load(posiciones[--pos]);
        board.position(posiciones[pos].split(" ")[0]);
        //makeBestMove();
        //turno
        var turno = document.getElementById("turno");
        turno.textContent = chess.turn()=="w" ? "juegan blancas" : "juegan negras";
        //jugada (nº)
        var volverJugada = document.getElementById("volver");
        var n = Math.trunc(pos/2) + 1;  
        var dondeVuelvo = "Volver a la jugada " + n + " donde " + turno.textContent;
        volverJugada.textContent = dondeVuelvo;
    }
    else{
        alert("Es la primera jugada, no puedes retroceder más.")
    }
}


function cargarJugada(nodo){
  //nodo es el span de la jugada
  let padre = nodo.target;
  var n = padre.id;
  chess.load(posiciones[n]);
  board.position(posiciones[n].split(" ")[0]);
  pos = n;
  //makeBestMove();
  //turno
  var turno = document.getElementById("turno");
  turno.textContent = chess.turn()=="w" ? "juegan blancas" : "juegan negras";
  //jugada (nº)
  var volverJugada = document.getElementById("volver");
  var n = Math.trunc(pos/2) + 1;  
  var dondeVuelvo = "Volver a la jugada " + n + " donde " + turno.textContent;
  volverJugada.textContent = dondeVuelvo;
}

function cargarJugadaAux(n){
  chess.load(posiciones[n]);
  board.position(posiciones[n].split(" ")[0]);
  pos = n;
  //makeBestMove();
}

function volverPos(n){
    chess.load(posiciones[pos]);
    board.position(posiciones[pos].split(" ")[0]);
  }

document.addEventListener("DOMContentLoaded",main, false);


//////IA//////
var score = 0;
function onChange() {
    makeBestMove();
};

var minimaxRoot =function(depth, chess, isMaximisingPlayer) {

    var newGameMoves = chess.moves();
    var bestMove = -9999;
    var bestMoveFound;

    for(var i = 0; i < newGameMoves.length; i++) {
        var newGameMove = newGameMoves[i]
        chess.move(newGameMove);
        var value = minimax(depth - 1, chess, -10000, 10000, !isMaximisingPlayer);
        chess.undo();
        if(value >= bestMove) {
            bestMove = value;
            bestMoveFound = newGameMove;
        }
    }
    score = bestMove
    return bestMoveFound;
};

var minimax = function (depth, chess, alpha, beta, isMaximisingPlayer) {
    positionCount++;
    if (depth === 0) {
        //return 0;
        return -evaluateBoard(chess.board());
    }

    var newGameMoves = chess.moves();

    if (isMaximisingPlayer) {
        var bestMove = -9999;
        for (var i = 0; i < newGameMoves.length; i++) {
            chess.move(newGameMoves[i]);
            bestMove = Math.max(bestMove, minimax(depth - 1, chess, alpha, beta, !isMaximisingPlayer));
            chess.undo();
            alpha = Math.max(alpha, bestMove);
            if (beta <= alpha) {
                return bestMove;
            }
        }
        return bestMove;
    } else {
        var bestMove = 9999;
        for (var i = 0; i < newGameMoves.length; i++) {
            chess.move(newGameMoves[i]);
            bestMove = Math.min(bestMove, minimax(depth - 1, chess, alpha, beta, !isMaximisingPlayer));
            chess.undo();
            beta = Math.min(beta, bestMove);
            if (beta <= alpha) {
                return bestMove;
            }
        }
        return bestMove;
    }
};

var evaluateBoard = function (board) {
    var totalEvaluation = 0;
    for (var i = 0; i < 8; i++) {
        for (var j = 0; j < 8; j++) {
            totalEvaluation = totalEvaluation + getPieceValue(board[i][j], i ,j);
        }
    }
    return totalEvaluation;
};

var reverseArray = function(array) {
    return array.slice().reverse();
};

var pawnEvalWhite =
    [
        [0.0,  0.0,  0.0,  0.0,  0.0,  0.0,  0.0,  0.0],
        [5.0,  5.0,  5.0,  5.0,  5.0,  5.0,  5.0,  5.0],
        [1.0,  1.0,  2.0,  3.0,  3.0,  2.0,  1.0,  1.0],
        [0.5,  0.5,  1.0,  2.5,  2.5,  1.0,  0.5,  0.5],
        [0.0,  0.0,  0.0,  2.0,  2.0,  0.0,  0.0,  0.0],
        [0.5, -0.5, -1.0,  0.0,  0.0, -1.0, -0.5,  0.5],
        [0.5,  1.0, 1.0,  -2.0, -2.0,  1.0,  1.0,  0.5],
        [0.0,  0.0,  0.0,  0.0,  0.0,  0.0,  0.0,  0.0]
    ];

var pawnEvalBlack = reverseArray(pawnEvalWhite);

var knightEval =
    [
        [-5.0, -4.0, -3.0, -3.0, -3.0, -3.0, -4.0, -5.0],
        [-4.0, -2.0,  0.0,  0.0,  0.0,  0.0, -2.0, -4.0],
        [-3.0,  0.0,  1.0,  1.5,  1.5,  1.0,  0.0, -3.0],
        [-3.0,  0.5,  1.5,  2.0,  2.0,  1.5,  0.5, -3.0],
        [-3.0,  0.0,  1.5,  2.0,  2.0,  1.5,  0.0, -3.0],
        [-3.0,  0.5,  1.0,  1.5,  1.5,  1.0,  0.5, -3.0],
        [-4.0, -2.0,  0.0,  0.5,  0.5,  0.0, -2.0, -4.0],
        [-5.0, -4.0, -3.0, -3.0, -3.0, -3.0, -4.0, -5.0]
    ];

var bishopEvalWhite = [
    [ -2.0, -1.0, -1.0, -1.0, -1.0, -1.0, -1.0, -2.0],
    [ -1.0,  0.0,  0.0,  0.0,  0.0,  0.0,  0.0, -1.0],
    [ -1.0,  0.0,  0.5,  1.0,  1.0,  0.5,  0.0, -1.0],
    [ -1.0,  0.5,  0.5,  1.0,  1.0,  0.5,  0.5, -1.0],
    [ -1.0,  0.0,  1.0,  1.0,  1.0,  1.0,  0.0, -1.0],
    [ -1.0,  1.0,  1.0,  1.0,  1.0,  1.0,  1.0, -1.0],
    [ -1.0,  0.5,  0.0,  0.0,  0.0,  0.0,  0.5, -1.0],
    [ -2.0, -1.0, -1.0, -1.0, -1.0, -1.0, -1.0, -2.0]
];

var bishopEvalBlack = reverseArray(bishopEvalWhite);

var rookEvalWhite = [
    [  0.0,  0.0,  0.0,  0.0,  0.0,  0.0,  0.0,  0.0],
    [  0.5,  1.0,  1.0,  1.0,  1.0,  1.0,  1.0,  0.5],
    [ -0.5,  0.0,  0.0,  0.0,  0.0,  0.0,  0.0, -0.5],
    [ -0.5,  0.0,  0.0,  0.0,  0.0,  0.0,  0.0, -0.5],
    [ -0.5,  0.0,  0.0,  0.0,  0.0,  0.0,  0.0, -0.5],
    [ -0.5,  0.0,  0.0,  0.0,  0.0,  0.0,  0.0, -0.5],
    [ -0.5,  0.0,  0.0,  0.0,  0.0,  0.0,  0.0, -0.5],
    [  0.0,   0.0, 0.0,  0.5,  0.5,  0.0,  0.0,  0.0]
];

var rookEvalBlack = reverseArray(rookEvalWhite);

var evalQueen = [
    [ -2.0, -1.0, -1.0, -0.5, -0.5, -1.0, -1.0, -2.0],
    [ -1.0,  0.0,  0.0,  0.0,  0.0,  0.0,  0.0, -1.0],
    [ -1.0,  0.0,  0.5,  0.5,  0.5,  0.5,  0.0, -1.0],
    [ -0.5,  0.0,  0.5,  0.5,  0.5,  0.5,  0.0, -0.5],
    [  0.0,  0.0,  0.5,  0.5,  0.5,  0.5,  0.0, -0.5],
    [ -1.0,  0.5,  0.5,  0.5,  0.5,  0.5,  0.0, -1.0],
    [ -1.0,  0.0,  0.5,  0.0,  0.0,  0.0,  0.0, -1.0],
    [ -2.0, -1.0, -1.0, -0.5, -0.5, -1.0, -1.0, -2.0]
];

var kingEvalWhite = [

    [ -3.0, -4.0, -4.0, -5.0, -5.0, -4.0, -4.0, -3.0],
    [ -3.0, -4.0, -4.0, -5.0, -5.0, -4.0, -4.0, -3.0],
    [ -3.0, -4.0, -4.0, -5.0, -5.0, -4.0, -4.0, -3.0],
    [ -3.0, -4.0, -4.0, -5.0, -5.0, -4.0, -4.0, -3.0],
    [ -2.0, -3.0, -3.0, -4.0, -4.0, -3.0, -3.0, -2.0],
    [ -1.0, -2.0, -2.0, -2.0, -2.0, -2.0, -2.0, -1.0],
    [  2.0,  2.0,  0.0,  0.0,  0.0,  0.0,  2.0,  2.0 ],
    [  2.0,  3.0,  1.0,  0.0,  0.0,  1.0,  3.0,  2.0 ]
];

var kingEvalBlack = reverseArray(kingEvalWhite);




var getPieceValue = function (piece, x, y) {
    if (piece === null) {
        return 0;
    }
    var getAbsoluteValue = function (piece, isWhite, x ,y) {
        if (piece.type === 'p') {
            return 10 + ( isWhite ? pawnEvalWhite[y][x] : pawnEvalBlack[y][x] );
        } else if (piece.type === 'r') {
            return 50 + ( isWhite ? rookEvalWhite[y][x] : rookEvalBlack[y][x] );
        } else if (piece.type === 'n') {
            return 30 + knightEval[y][x];
        } else if (piece.type === 'b') {
            return 30 + ( isWhite ? bishopEvalWhite[y][x] : bishopEvalBlack[y][x] );
        } else if (piece.type === 'q') {
            return 90 + evalQueen[y][x];
        } else if (piece.type === 'k') {
            return 900 + ( isWhite ? kingEvalWhite[y][x] : kingEvalBlack[y][x] );
        }
        throw "Unknown piece type: " + piece.type;
    };

    var absoluteValue = getAbsoluteValue(piece, piece.color === 'w', x ,y);
    return piece.color === 'w' ? absoluteValue : -absoluteValue;
};


/* board visualization and games state handling */

/*var onDragStart = function (source, piece, position, orientation) {
    if (chess.in_checkmate() === true || chess.in_draw() === true ||
        piece.search(/^b/) !== -1) {
        return false;
    }
};*/

var makeBestMove = function () {
    let check = document.getElementById("IA");
    var valoration = document.getElementById("valoration");
    valoration.textContent="Actualizando valoración...";
    if(check.value=="on"){
        var bestMove = getBestMove(chess);
        valoration.textContent=score;
    }
    else{
        valoration.textContent="Desactivado";
    }

    /*
    //el color
    var turno = document.getElementById("turno");
    if(chess.turn()=="w"){
        var color = "juegan blancas";
    }
    else{
        var color = "juegan negras";
    }
    turno.textContent = color;
    //jugada (nº)
    var volverJugada = document.getElementById("volver");
    var n = Math.trunc(pos/2) + 1;  
    var dondeVuelvo = "Volver a la jugada " + n + " donde " + turno.textContent;
    volverJugada.textContent = dondeVuelvo;*/
};


var positionCount;
var getBestMove = function (chess) {
    if (chess.game_over()) {
        alert('Game over');
    }

    positionCount = 0;
    //cuando se seleccionaba iba así: var depth = parseInt($('#search-depth').find(':selected').text());
    var depth = 2;
    var bestMove = minimaxRoot(depth, chess, true);

    return bestMove;
};

var renderMoveHistory = function (moves) {
    var historyElement = $('#move-history').empty();
    historyElement.empty();
    for (var i = 0; i < moves.length; i = i + 2) {
        historyElement.append('<span>' + moves[i] + ' ' + ( moves[i + 1] ? moves[i + 1] : ' ') + '</span><br>')
    }
    //historyElement.scrollTop(historyElement[0].scrollHeight);

};
//función principal
/*var onDrop = function (source, target) {

    var move = chess.move({
        from: source,
        to: target,
        promotion: 'q'
    });

    removeGreySquares();
    if (move === null) {
        return 'snapback';
    }

    renderMoveHistory(chess.history());
    window.setTimeout(makeBestMove, 250);
    //muestro la valoración
    var valoration = document.getElementById("valoration");
    valoration.textContent=score;
};*/

var onSnapEnd = function () {
    board.position(chess.fen());
};

var onMouseoverSquare = function(square, piece) {
    var moves = chess.moves({
        square: square,
        verbose: true
    });

    if (moves.length === 0) return;

    greySquare(square);

    for (var i = 0; i < moves.length; i++) {
        greySquare(moves[i].to);
    }
};

var onMouseoutSquare = function(square, piece) {
    removeGreySquares();
};

var removeGreySquares = function() {
    $('#board .square-55d63').css('background', '');
};

var greySquare = function(square) {
    var squareEl = $('#board .square-' + square);

    var background = '#a9a9a9';
    if (squareEl.hasClass('black-3c85d') === true) {
        background = '#696969';
    }

    squareEl.css('background', background);
};
