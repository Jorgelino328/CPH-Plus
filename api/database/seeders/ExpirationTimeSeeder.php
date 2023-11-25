<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExpirationTimeSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\ExpirationTime::insert([
            ['label' => 'Never'     , 'seconds' => 0                 ],
            ['label' => '10 minutes', 'seconds' => 10  * 60          ],
            ['label' => '1 hour'    , 'seconds' => 60  * 60          ],
            ['label' => '1 day'     , 'seconds' => 24  * 60 * 60     ],
            ['label' => '1 week'    , 'seconds' => 7   * 24 * 60 * 60],
            ['label' => '1 month'   , 'seconds' => 30  * 24 * 60 * 60],
            ['label' => '1 year'    , 'seconds' => 365 * 24 * 60 * 60],
        ]);
    }
}
