<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Game;
use App\Player;

class GameController extends Controller
{

    public function practicar(){
        return view("/practicar");
    }
    public function crearPartida(Request $request)
    {
        //dd($request->all());
        //resultado
        if($request->input("resultado")=="blancas"){
            $result = 0;
        }
        else if($request->input("resultado")=="negras"){
            $result = 2;
        }
        else{
            $result = 1;
        }
        
        $game = new Game();
        
        ////////
        $game->id_white = $this->idJugador($request->input('nombre_blancas'),$request->input('apellido_blancas'),
        $request->input('pais_blancas'),$request->input('Elo_blancas'),$request->input('titulo_blancas'));
        
        $game->id_black = $this->idJugador($request->input('nombre_negras'),$request->input('apellido_negras'),
        $request->input('pais_negras'),$request->input('Elo_negras'),$request->input('titulo_negras'));
        ////////
        $movimientos = $request->input('mov');
        $game->title_white = $request->input('titulo_blancas');
        $game->title_black = $request->input('titulo_negras');
        $game->country_white = $request->input('pais_blancas');
        $game->country_black = $request->input('pais_negras');
        $game->name_white = $request->input('nombre_blancas');
        $game->surname_white = $request->input('apellido_blancas');
        $game->ranking_white = $request->input('Elo_blancas');
        $game->name_black = $request->input('nombre_negras');
        $game->surname_black = $request->input('apellido_negras');
        $game->ranking_black = $request->input('Elo_negras');
        $game->tournament = $request->input("torneo");
        $game->result = $result;
        $game->movements = $movimientos;
        $game->movements_processed = $this->ConvierteMovimientos($movimientos);
        //$game->game_verified = 1;
        $game->save();
        
        //$usuario = User::create($request(['name', 'email', 'password']));
        $games = DB::table('games')->paginate(10);
        //debug($user);
        return redirect("partidas")->with('games',$games);
    }

    public function crearJugador($nombre,$apellido,$pais,$elo,$titulo){
        $player = new Player();

        $player->name = $nombre;
        $player->surname = $apellido;
        $player->country = $pais;
        $player->ranking = $elo;
        $player->title = $titulo;

        $player->save();

        return $player->id;
    }

    public function ActualizaPlayer($id,$nombre,$apellido,$pais,$elo,$titulo){
        $player = Player::where('id', 'like', '%'.$id.'%')->first();
        $player->name = $nombre;
        $player->surname = $apellido;
        $player->ranking = $elo;
        $player->country = $pais;
        $player->title = $titulo;
        $player->save();
        /*$players = Player::where('id', 'like', '%'.$id.'%')->get();        
        //dd($player);
        foreach ($players as $player){
            $player->name = $nombre;
            $player->surname = $apellido;
            $player->ranking = $elo;
            $player->country = $pais;
            $player->title = $titulo;

            $player->save();
        }*/
        
    }
    public function idJugador($nombre,$apellido,$pais,$elo,$titulo){
        $consulta = DB::table('players')
        ->where('name', '=', $nombre)
        ->where('surname', '=', $apellido)
        ->where('country', '=', $pais)
        ->where('ranking', '=', $elo)
        ->where('title', '=', $titulo);
        
        $players = $consulta->count();

        //dd($players);

        if($players>0){
            $player = $consulta->first();
            return $player->id;
        }
        else{
            //$new_id = $this->sumaUno();
            $new_id = $this->crearJugador($nombre,$apellido,$pais,$elo,$titulo);
            return $new_id;
        }
    }


    
    /*public function sumaUno(){
        //$max = Player::find(\DB::table('players')->max('id'));
        $id_last = DB::table('players')->where('id', \DB::raw("(select max(`id`) from players)"))->first();
        $id = $id_last->id + 1;
        return $id;
    }*/

    public function ConvierteMovimientos($movimientos){
        //1. e4 e6 2. d4 d5
        //e4 d5,d4 d5
        $movimientos_array = explode(" ", $movimientos);
        $tam = sizeOf($movimientos_array);
        $movimientos_processed = "";
        for($i = 1; $i<$tam;$i+=3){
            $first = $movimientos_array[$i++];
            $second = ($i<$tam-1) ? ($movimientos_array[$i].",") : "";
            $movimientos_processed .= $first." ".$second;
        }
        return $movimientos_processed;
    }


    public function devolverFormularioPartida(){
        return view('/registrarPartida');
    }

    public function buscar(Request $request){
        $nombre = $request->input('nombre');
        $torneo = $request->input('torneo');
        $ranking = $request->input('ranking');
        $jugador = $request->input("jugador_buscar");
        $games = DB::table('games');
        //->paginate(6);
        //para paginar, revisar más arriba  
        if($nombre!=""){
            $games = $games->where(function($q) use ($nombre){
                $q->where('name_white', 'like', '%'.$nombre.'%')
                ->orWhere('surname_white', 'like', '%'.$nombre.'%')
                ->orWhere('name_black', 'like', '%'.$nombre.'%')
                ->orWhere('surname_black', 'like', '%'.$nombre.'%');
            });
        }
        if($torneo!=""){
            $games = $games->where('tournament', 'like', '%'.$torneo.'%');
        }
        if($ranking!=""){
            if($jugador=="Jugador blancas"){
                $games = $games->where('ranking_white', '>=', $ranking);
            }
            else if($jugador=="Jugador blancas"){
                $games = $games->where('ranking_black', '>=', $ranking);
            }
            else{
                //ambos
                $games = $games->where(function($elo) use ($ranking){
                    $elo->where('ranking_white', '>=', $ranking)
                    ->orWhere('ranking_black', '>=', $ranking);
                });
            }
        }
        //echo $games->dd();
        $games = $games->paginate(10);
        return view('verPartidas')->with('games',$games);
    }

    public function partida($partida){
        $game = DB::table('games')->where('id', '=', $partida)->first();

        $result = $this->obtenerResultado($game->result);
        $Elo_blancas = $this->obtenerEloBlancas($game->ranking_white);
        $Elo_negras = $this->obtenerEloNegras($game->ranking_black);
        

        return view('partida')->with('game',$game)->with('result',$result)->with('Elo_blancas',$Elo_blancas)->with('Elo_negras',$Elo_negras);
    }

    public function obtenerResultado($r) {
        if($r==0){
            return "1 - 0";
        }
        else{
            if($r==1){
                return "1/2 - 1/2";
            }
            else{
                //r==2
                return "0 - 1";
            }
        }
    }

    public function obtenerEloBlancas($ranking_white){
        if($ranking_white==0){
            return "";
        }
        else{
            return $ranking_white;
        }
    }

    public function obtenerEloNegras($ranking_black){
        if($ranking_black==0){
            return "";
        }
        else{
            return $ranking_black;
        }
    }


    public function verPartidas(){
        
        //muestro las partidas de la bd
        $games = DB::table('games')->paginate(10);
        return view('verPartidas')->with('games',$games);
    }

    /*
    public function crearJugadorV2($nombre,$apellido,$elo){
        $player = new Player();

        $player->name = $nombre;
        $player->surname = $apellido;
        $player->country = 'INTERNATIONAL';
        $player->ranking = $elo;
        $player->title = 'none';

        $player->save();

        return $player->id;
    }

    public function idJugadorV2($nombre,$apellido,$elo){
        $consulta = DB::table('players')
        ->where('name', '=', $nombre)
        ->where('surname', '=', $apellido)
        ->where('ranking', '=', $elo);
        
        $players = $consulta->count();

        //dd($players);

        if($players>0){
            $player = $consulta->first();
            return $player->id;
        }
        else{
            //$new_id = $this->sumaUno();
            $new_id = $this->crearJugadorV2($nombre,$apellido,$elo);
            return $new_id;
        }
    }*/

    public function ConvierteMovimientosV2($movimientos){
        //1.e4 e6 2.d4 d5
        //e4 d5,d4 d5
        $movimientos_array = explode(".", $movimientos);
        //Ahora tengo: [1,e4 e5 2, d4 d5]
        $tam = sizeOf($movimientos_array);
        $movimientos_processed = "";
        for($i = 1; $i<$tam;$i++){
            $aux_string = $movimientos_array[$i];
            $aux_array = explode(" ", $aux_string);
            $aux_tam = sizeOf($aux_array);
            for($j=0;$j<$aux_tam;$j+=2){
                $first = $aux_array[$j++];
                $second = ($j<$aux_tam-1) ? ($aux_array[$j].",") : "";
                $movimientos_processed .= $first." ".$second;
            }
            
        }
        return $movimientos_processed;
    }

    public function execAdmin(Request $request){
        $id = $request->input('id');

        $name_white = $request->input('name_white');
        $surname_white = $request->input('surname_white');
        $ranking_white = $request->input('ranking_white');
        $country_white = $request->input('country_white');
        $title_white = $request->input('title_white');

        $name_black = $request->input('name_black');
        $surname_black = $request->input('surname_black');
        $ranking_black = $request->input('ranking_black');
        $country_black = $request->input('country_black');
        $title_black = $request->input('title_black');

        $tournament = $request->input('tournament');
        $result = $request->input('result');
        $movements = $request->input('movements');
        //dd($request);
        if($request->input('type')=="edit"){ 
            $this->updateAdmin($id, $name_white,$surname_white,$ranking_white,$country_white,$title_white,
            $name_black,$surname_black,$ranking_black,$country_black,$title_black,
            $tournament, $result, $movements);
        }
        else{
            if($request->input('type')=="insert"){
                $this->insertAdmin($name_white,$surname_white,$ranking_white,$country_white,$title_white,
                $name_black,$surname_black,$ranking_black,$country_black,$title_black,
                $tournament, $result, $movements);
            }
            else{
                //borrar - delete;
                $this->deleteAdmin($id);
            }
        }
        return redirect()->back();
    }

    public function insertAdmin($name_white,$surname_white,$ranking_white,$country_white,$title_white,
    $name_black,$surname_black,$ranking_black,$country_black,$title_black,
    $tournament, $result, $movements)
    {
        
        $game = new Game();

        $game->id_white = $this->idJugador($name_white,$surname_white,$country_white,$ranking_white,$title_white);
        
        $game->id_black = $this->idJugador($name_black,$surname_black,$country_black,$ranking_black,$title_black);

        $game->name_white = $name_white;
        $game->surname_white = $surname_white;
        $game->ranking_white = $ranking_white;
        $game->country_white = $country_white;
        $game->title_white = $title_white;

        $game->name_black = $name_black;
        $game->surname_black = $surname_black;
        $game->ranking_black = $ranking_black;
        $game->country_black = $country_black;
        $game->title_black = $title_black;

        $game->tournament = $tournament;
        $game->result = $result;
        $game->movements = $movements;

        $game->movements_processed = $this->ConvierteMovimientosV2($movements);

        $game->save();

        return redirect()->back();
    }

    public function deleteAdmin($id){
        $game = Game::where('id', '=', $id)->first();
        $game->delete();
        $games = Game::orderby('id')->paginate(9);
    }

    public function updateAdmin($id, $name_white,$surname_white,$ranking_white,$country_white,$title_white,
    $name_black,$surname_black,$ranking_black,$country_black,$title_black,
    $tournament, $result, $movements)
    {
        $game = Game::where('id', 'like', '%'.$id.'%')->first();        
        
        $game->id_white = $this->idJugador($name_white,$surname_white,$country_white,$ranking_white,$title_white);
        //llamo a actualizar player por si los datos de ese jugador con ese id hubieran cambiado
        $this->ActualizaPlayer($game->id_white,$name_white,$surname_white,$country_white,$ranking_white,$title_white);

        $game->id_black = $this->idJugador($name_black,$surname_black,$country_black,$ranking_black,$title_black);
        //llamo a actualizar player por si los datos de ese jugador con ese id hubieran cambiado
        $this->ActualizaPlayer($game->id_black,$name_black,$surname_black,$country_black,$ranking_black,$title_black);

        $game->name_white = $name_white;
        $game->surname_white = $surname_white;
        $game->ranking_white = $ranking_white;
        $game->country_white = $country_white;
        $game->title_white = $title_white;

        $game->name_black = $name_black;
        $game->surname_black = $surname_black;
        $game->ranking_black = $ranking_black;
        $game->country_black = $country_black;
        $game->title_black = $title_black;

        $game->tournament = $tournament;
        $game->result = $result;
        $game->movements = $movements;

        $game->save();
        return redirect()->back();        
    }

    //admin
    public function adminGame()
    {
        $games = Game::orderBy('id')->paginate(9);
        return view("adminGame")->with('games', $games);
    }
}
