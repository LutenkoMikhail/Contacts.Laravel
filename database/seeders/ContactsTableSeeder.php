<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::factory()
            ->count(30)
            ->hasphoneNumber(2)
            ->create();

        $this->command->info('Contacts and Phone numbers table loaded with data!');
    }
}
