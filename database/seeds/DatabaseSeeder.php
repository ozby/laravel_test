<?php

use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: ozby
 * Date: 05.07.18
 * Time: 19:16
 */


class DatabaseSeeder extends Seeder {

    public function run()
    {
        $this->call('UserTableSeeder');
        $this->call('MessageTableSeeder');
    }

}