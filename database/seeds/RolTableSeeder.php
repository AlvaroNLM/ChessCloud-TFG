<?php

use Illuminate\Database\Seeder;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rol')->delete();
        
        Schema::table('rol', function($table){
            $table->string('rol');
        });

        DB::table('rol')->insert([
            'rol' => 'usuario']);
        DB::table('rol')->insert([
            'rol' => 'editor']);
        DB::table('rol')->insert([
            'rol' => 'administrador']);
    }
}
