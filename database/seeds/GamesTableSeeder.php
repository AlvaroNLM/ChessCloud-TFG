<?php

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->delete();
        Schema::table('games', function($table){
            $table->integer('id_white');
            $table->string('name_white');
            $table->string('surname_white');
            $table->integer('ranking_white');
            $table->string('title_white');
            $table->string('country_white');
            //$table->foreign('id_white')->references('id')->on('players')->onDelete('cascade');
            $table->integer('id_black');
            $table->string('name_black');
            $table->string('surname_black');
            $table->integer('ranking_black');
            $table->string('title_black');
            $table->string('country_black');
            //$table->foreign('id_black')->references('id')->on('players')->onDelete('cascade');
            $table->string('tournament');
            $table->integer('result');
            $table->text('movements');
            $table->text('movements_processed');
        });
        
        $cantidad_jugadores = DB::table('players')->count();
        //print_r($cantidad_jugadores);
        $TAM = 50;
        for($i = 0;$i < $TAM;$i++){
            $id_blancas = rand(0,$cantidad_jugadores-1);
            $id_negras = rand(0,$cantidad_jugadores-1);
            while($id_blancas === $id_negras){
                 $id_negras = rand(0,$cantidad_jugadores-1);
            }

            $jugador_blancas = DB::table('players')->where('id', $id_blancas)->get()->first();
            $jugador_negras = DB::table('players')->where('id', $id_negras)->get()->first();
            $torneo_aux = $this->randTournament();
            //hago la semilla fuera ya que los arrays dos partidas siempre tendrán el mismo número de partidas (datos de ejemplo)
            $semilla = rand(0,1);
            $partida_aux = $this->jugadasPartida($semilla);
            $partida_aux_processed = $this->jugadasPartidaProcessed($semilla);
            DB::table('games')->insert([
                'id_white' => $id_blancas,
                'name_white' => $jugador_blancas->name,
                'surname_white' => $jugador_blancas->surname,
                'ranking_white' => $jugador_blancas->ranking,
                'title_white' => $jugador_blancas->title,
                'country_white' => $jugador_blancas->country,
                'id_black' => $id_negras,
                'name_black' => $jugador_negras->name,
                'surname_black' => $jugador_negras->surname,
                'ranking_black' => $jugador_negras->ranking,
                'title_black' => $jugador_negras->title,
                'country_black' => $jugador_negras->country,
                'tournament' => $torneo_aux,
                'movements' => $partida_aux,
                'movements_processed' => $partida_aux_processed,
                'result' => rand(0,2)]);//0 white, 1 draw, 2 black
        }

    }

    private function randTournament(){
        $tipo = array('Open', 'Liga', 'Magistral');
        $torneo = array('Barcelona', 'Beijing', 'Moscow', 'Linares', 'Londres');
        $stringaux = $tipo[rand(0,count($tipo)-1)]." ".$torneo[rand(0,count($torneo)-1)];
        return $stringaux;
    }


    private function jugadasPartidaProcessed($semilla){
        $partidas = array('e4 e6,b3 d5,Bb2 dxe4,Nc3 Nd7,Nxe4 Ngf6,Nc3 Be7,g3 0–0,Bg2 c6,Nge2 Nd5,a4 Nxc3,Nxc3 Nf6,0–0 Nd5,Ba3 Bxa3,Rxa3 Nxc3,dxc3 Qe7,Ra1 Rd8,Qe2 Bd7,Rfd1 Be8,Rd4 Qf6,Rad1 Rxd4,Rxd4 Rd8,Qd2 Rxd4,Qxd4',
        'c4 e5,Nc3 Nc6,Nf3 d6,d4 Nxd4,Nxd4 exd4,Qxd4 Qf6,Qd2 Be6,b3 Qg6,Bb2 Nf6,Nb5 Ne4,Qf4 0–0–0,f3 Nc5,Nxa7+ Kb8,Nb5 Be7,h4 h6,Bd4 Bd7,0–0–0 Bxb5,cxb5 Ne6,Qg4 Qxg4,fxg4 Nxd4,Rxd4 Bf6,Rd5 Rde8,Rh3 Re4,g5 Be5,Rf3 hxg5,hxg5 Rh1');
        
        return $partidas[$semilla];
    }

    private function jugadasPartida($semilla){
        $partidas = array('1.e4 e6 2.b3 d5 3.Bb2 dxe4 4.Nc3 Cd7 5.Nxe4 Ngf6 
        6.Nc3 Be7 7.g3 0–0 8.Bg2 c6 9.Nge2 Nd5 10.a4 Nxc3
        11.Nxc3 Nf6 12.0–0 Nd5 13.Ba3 Bxa3 14.Rxa3 Nxc3 15.dxc3 Qe7 
        16.Ra1 Rd8 17.Qe2 Bd7 18.Rfd1 Be8 19.Rd4 Qf6 
        20.Rad1 Rxd4 21.Rxd4 Rd8 22.Qd2 Rxd4 23.Qxd4',
        '1.c4 e5 2.Nc3 Nc6 3.Nf3 d6 4.d4 Nxd4 5.Nxd4 exd4 
        6.Qxd4 Qf6 7.Qd2 Be6 8.b3 Qg6 9.Bb2 Nf6 10.Nb5 Ne4 
        11.Qf4 0–0–0 12.f3 Nc5 13.Nxa7+ Kb8 14.Nb5 Be7 15.h4 h6 
        16.Bd4 Bd7 17.0–0–0 Bxb5 18.cxb5 Ne6 19.Qg4 Qxg4 
        20.fxg4 Nxd4 21.Rxd4 Bf6 22.Rd5 Rde8 23.Rh3 Re4 24.g5 Be5 
        25.Rf3 hxg5 26.hxg5 Rh1');
        return $partidas[$semilla];
    }

}
