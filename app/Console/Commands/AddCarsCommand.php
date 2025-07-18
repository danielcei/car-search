<?php

namespace App\Console\Commands;

use App\Models\Car;
use Illuminate\Console\Command;

class AddCarsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-cars-command {count=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Fake Cars';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = (int) $this->argument('count');

        Car::factory($count)
            ->create();

        $this->info("Successfully added {$count} cars with relationships.");
    }
}
