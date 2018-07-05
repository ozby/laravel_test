<?php

use Illuminate\Database\Seeder;
//use Jenssegers\Mongodb\Eloquent\Model;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seed = json_decode(file_get_contents('database/seeds/messages_sample.json'), true);
        if (!is_array($seed) || !isset($seed["messages"])) {
            $this->command->alert("Seed file corrupted.");
            return;
        }

        $allowedFields = ['uid', 'sender', 'subject', 'message', 'time_sent'];
        $nameConversion = ['uid' => '_id'];

        foreach ($seed["messages"] as $seedMessage) {
            $message = new \App\Message;
            foreach ($seedMessage as $key => $value) {
                if (!in_array($key, $allowedFields)) {
                    continue;
                }
                if (isset($nameConversion[$key])) {
                    $key = $nameConversion[$key];
                }
                $message->$key = $value;
            }
            $message->save();
            unset($message);
        }

        $this->command->info('Message table seeded!');
    }
}
