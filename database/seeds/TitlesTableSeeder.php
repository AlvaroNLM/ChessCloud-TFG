<?php

use Illuminate\Database\Seeder;

class TitlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('titles')->delete();
        Schema::table('titles', function($table){
            $table->string('title');
        });

        DB::table('titles')->insert([
            'title' => 'None']);//no titulado
        DB::table('titles')->insert([
            'title' => 'CM']);
        DB::table('titles')->insert([
            'title' => 'WCM']);
        DB::table('titles')->insert([
            'title' => 'FM']);
        DB::table('titles')->insert([
            'title' => 'WFM']);
        DB::table('titles')->insert([
            'title' => 'IM']);
        DB::table('titles')->insert([
            'title' => 'WIM']);
        DB::table('titles')->insert([
            'title' => 'GM']);
        DB::table('titles')->insert([
            'title' => 'WGM']);
    }
}
