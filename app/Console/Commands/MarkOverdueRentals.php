<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Rental;
use Carbon\Carbon;
use App\Mail\OverdueRentalNotification;
use Illuminate\Support\Facades\Mail;


class MarkOverdueRentals extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rentals:mark-overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark rentals as overdue if not returned within 2 weeks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $overdueRentals = Rental::where('due_date', '<', Carbon::now())
                                ->where('overdue', 0)
                                ->get();

        foreach ($overdueRentals as $rental) {
            $rental->update(['overdue' => 1]);

            // Send email notification

            //Mail::to($rental->user->email)->send(new OverdueRentalNotification($rental));
        }

        $this->info('Overdue rentals marked and notifications sent successfully.');
    }
}
