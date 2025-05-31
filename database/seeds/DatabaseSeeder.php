<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //1 ROL
        $this->call(RolTableSeeder::class);
        $this->command->info('Tabla rol rellenada');
        //2 USERS
        $this->call(UsersTableSeeder::class);
        $this->command->info('Tabla users rellenada');
        //3 ROL_USERS -> no hace falta porque es 1:N no N:N
        //$this->call(RolUsersTableSeeder::class);
        //$this->command->info('Tabla rol_user rellenada');
        //lo siguiente queda a la espera de ver si el js será para jugar o para analizar, 
        //de momento gestión de usuarios
        //4 TITLE
        $this->call(TitlesTableSeeder::class);
        $this->command->info('Tabla titles rellenada');
        //5 PLAYERS
        $this->call(PlayersTableSeeder::class);
        $this->command->info('Tabla players rellenada');
        //6 PLAYER_TITLES -> no hace falta porque es 1:N no N:N
        //$this->call(PlayerTitlesTableSeeder::class);
        //$this->command->info('Tabla playerTitles rellenada');
        //7 ASSESMENTS -> sería para los movimientos (su valoración)
        //$this->call(AssesmentsTableSeeder::class);
        //$this->command->info('Tabla assesments rellenada');
        //8 GAMES
        $this->call(GamesTableSeeder::class);
        $this->command->info('Tabla games rellenada');
    }
}
