<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Division;
use App\Models\Ambassador;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        Ambassador::truncate();

        $ambassador = new Ambassador();
        $ambassador->name = "Jordyn Herwitz";
        $ambassador->save();

        $ambassador = new Ambassador();
        $ambassador->name = "Carla Siphron";
        $ambassador->save();

        $ambassador = new Ambassador();
        $ambassador->name = "Terry Press";
        $ambassador->save();

        $ambassador = new Ambassador();
        $ambassador->name = "Kierra Rosser";
        $ambassador->save();

        $ambassador = new Ambassador();
        $ambassador->name = "Tom Walker";
        $ambassador->save();

        $ambassador = new Ambassador();
        $ambassador->name = "Judy Beltran";
        $ambassador->save();

            
        Division::truncate();

        $division = new Division;
        $division->name = "Dirección General";
        $division->id_parent = 0;
        $division->level = 1;
        $division->collaborators = 11;
        $division->id_ambassador = 1;
        $division->save();

        $division = new Division;
        $division->name = "Operaciones";
        $division->id_parent = 0;
        $division->level = 1;
        $division->collaborators = 8;
        $division->id_ambassador = 0;
        $division->save();

        $division = new Division;
        $division->name = "Producto";
        $division->id_parent = 0;
        $division->level = 1;
        $division->collaborators = 8;
        $division->id_ambassador = 0;
        $division->save();

        $division = new Division;
        $division->name = "CEO";
        $division->id_parent = 2;
        $division->level = 3;
        $division->collaborators = 6;
        $division->id_ambassador = 3;
        $division->save();

        $division = new Division;
        $division->name = "Strategy";
        $division->id_parent = 1;
        $division->level = 4;
        $division->collaborators = 7;
        $division->id_ambassador = 4;
        $division->save();

        $division = new Division;
        $division->name = "Growth";
        $division->id_parent = 3;
        $division->level = 4;
        $division->collaborators = 4;
        $division->id_ambassador = 2;
        $division->save();

        $division = new Division;
        $division->name = "Marketing";
        $division->id_parent = 3;
        $division->level = 3;
        $division->collaborators = 8;
        $division->id_ambassador = 0;
        $division->save();

        $division = new Division;
        $division->name = "Administración";
        $division->id_parent = 1;
        $division->level = 2;
        $division->collaborators = 12;
        $division->id_ambassador = 5;
        $division->save();

        $division = new Division;
        $division->name = "Finanzas";
        $division->id_parent = 1;
        $division->level = 3;
        $division->collaborators = 4;
        $division->id_ambassador = 6;
        $division->save();

        $division = new Division;
        $division->name = "Investigación";
        $division->id_parent = 2;
        $division->level = 4;
        $division->collaborators = 5;
        $division->id_ambassador = 0;
        $division->save();

        $division = new Division;
        $division->name = "Contabilidad";
        $division->id_parent = 8;
        $division->level = 2;
        $division->collaborators = 10;
        $division->id_ambassador = 0;
        $division->save();
    }
}
