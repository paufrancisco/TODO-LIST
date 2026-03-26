<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Todo::create(['title' => 'Learn Laravel',  'is_done' => false]);
        Todo::create(['title' => 'Learn Vue.js',   'is_done' => false]);
        Todo::create(['title' => 'Build an API',   'is_done' => true]);
        Todo::create(['title' => 'Connect Axios',  'is_done' => false]);
        Todo::create(['title' => 'Deploy the app', 'is_done' => false]);
    }
}
