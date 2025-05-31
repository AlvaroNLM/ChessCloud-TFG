<?php

use Illuminate\Database\Seeder;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('players')->delete();
        Schema::table('players', function($table){
            $table->string('name');
            $table->string('surname');
            $table->string('country')->default('International');
            $table->integer('ranking')->default(0);
            $table->string('title')->default('none');
            //$table->foreign('title')->references('title')->on('titles')->onDelete('cascade');
        });

        $TAM = 100;        
        for($i = 0;$i < $TAM;$i++){
            $names = $this->randName();
            $surnames = $this->randSurname();
            $pais = $this->randCountry();
            $elo = rand(0,1800);
            if($elo<1000){$elo=0;}
            DB::table('players')->insert([
                'name' => $names,
                'surname' => $surnames,
                'ranking' => $elo,
                'country' => $pais,
                ]);//'colour' => rand(0,1)//colour: 0 white, 1 black
        }

    }
    private function randName(){
        $nombres = array('Pablo', 'Manuel', 'Clara', 'David', 'Alvaro', 'Carlos', 'Francisco', 'Javier', 'Aitor', 'Angel', 'Nerea', 'Carmen', 'Alba', 'Eugenio', 'Albert', 'Flanagan');
        $stringaux = $nombres[rand(0,count($nombres)-1)];
        return $stringaux;
    }
    private function randSurname(){
        $apellidos = array('Lopez', 'Perez', 'Belmar', 'Navarro', 'Carmona', 'Epifanio', 'Rodes', 'Bolson', 'Tejedor', 'Tevar', 'Garcia', 'Rodriguez', 'Jimenez', 'Galindo');
        $stringaux = $apellidos[rand(0,count($apellidos)-1)];
        return $stringaux;
    }

    private function randCountry(){
        $paises = array('España', 'Francia', 'Portugal', 'Reino Unido', 'Alemania', 'Italia', 'USA', 'Rusia', 'China', 'India', 'Grecia', 'Cuba');
        $stringaux = $paises[rand(0,count($paises)-1)];
        return $stringaux;
    }
}
