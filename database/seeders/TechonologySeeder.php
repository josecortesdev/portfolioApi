<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Seeder;

class TechonologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->save('BOOTSTRAP', 'morado');
        $this->save('TYPESCRIPT', 'primary');
        $this->save('ANGULAR', 'danger');
        $this->save('PHP', 'dark');
        $this->save('LARAVEL: SOCIALITE Y CASHIER', 'naranja');
        $this->save('JWT', 'morado');
        $this->save('OAUTH', 'dark');
        $this->save('STRIPE', 'primary');
        $this->save('MYSQL', 'naranja');

        $this->save('JAVASCRIPT', 'warning');
        $this->save('JAVA', 'naranja');
        $this->save('SPRING BOOT', 'success');
        $this->save('JPA', 'marron');
    }
    public function save($name, $color)
    {
        $techonology = new Technology();
        $techonology->name = $name;
        $techonology->color = $color;
        $techonology->save();
    }
}
