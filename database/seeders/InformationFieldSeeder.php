<?php

namespace Database\Seeders;

use App\Models\InformationField;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformationFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        $this->save('name', 'JOSÉ CORTÉS');
        $this->save('introduction', 'PROGRAMADOR WEB');
        $this->save('githubLink', 'https://github.com/josecortesdev');
        $this->save('emailLink', 'https://mail.google.com/mail/u/0/?tf=cm&fs=1&to=josecortesdev@gmail.com&hl=es');
        $this->save('LinkedinLink', 'https://www.linkedin.com/in/josecortesdev');
        $this->save('emailFooter', 'josecortesdev@gmail.com');
    }

    public function save($name, $value)
    {
        $informationField = new InformationField();
        $informationField->name = $name;
        $informationField->value = $value;
        $informationField->save();
    }
   
}
