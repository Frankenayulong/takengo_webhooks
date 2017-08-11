<?php

use Illuminate\Database\Seeder;
use App\Repository;
class RepositoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$repository = new Repository;
    	$repository->name = 'takengo_frontend';
    	$repository->full_name = 'frankenayulong/takengo_frontend';
    	$repository->full_path = '/var/www/takengo.io';
    	$repository->save();

        $repository = new Repository;
    	$repository->name = 'takengo_admin';
    	$repository->full_name = 'frankenayulong/takengo_admin';
    	$repository->full_path = '/var/www/admin.takengo.io';
    	$repository->save();

        $repository = new Repository;
    	$repository->name = 'takengo_api';
    	$repository->full_name = 'frankenayulong/takengo_api';
    	$repository->full_path = '/var/www/api.takengo.io';
    	$repository->save();
    }
}
