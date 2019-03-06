<?php
namespace App\Console\Commands;

use App\Models\Schedule;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketSeat;

use Carbon\Carbon;
use Illuminate\Console\Command;
use DB;

class CancelTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cancel:tickets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel ticket after 30 minutes of booking if not yet paid';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // add available seats in the schedule
        $tickets_sum = Ticket::selectRaw('Sum(total_seats) AS seats, schedule_id')->where([
            ['created_at', '<=', Carbon::now()->subMinutes(30)->toDateTimeString()],
            ['paid', 0]
        ])->groupBy('schedule_id')->get();
        if($tickets_sum !== null){
            foreach($tickets_sum as $tickets){
                $schedule = Schedule::find($tickets->schedule_id);
                $schedule->avail_seats += $tickets->seats;
                $schedule->save();
            }
        }

        // Select tickets which are booked before 30 mints but not yet paid
        $tickets = Ticket::where([
            ['created_at', '<=', Carbon::now()->subMinutes(30)->toDateTimeString()],
            ['paid', 0]
        ])->select('id');

        // Delete tickets & seats which are booked before 30 mints but not yet paid
        $seats = TicketSeat::whereIn('ticket_id', $tickets)->delete();
        $tickets->delete();

        $this->info($tickets_sum);

    }
}
