<?php

namespace App\Console\Commands;

use App\Mail\AdvertiserAdsReminder;
use App\Models\Ad;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdvertisersReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'advertisers:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to advertisers who have ads the next day';

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
     * @return int
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $ads = Ad::whereRaw("Date(start_date) = '{$tomorrow}'")->get();

        if ($ads->isNotEmpty()) {
            foreach ($ads as $ad) {
                // Suppose that ads must have advertiser
                Mail::to($ad->advertiser->email)->send(new AdvertiserAdsReminder($ad));
                Log::info('email', ['advertiser email' => $ad->advertiser->email, 'ad name' => $ad->name]);
            }
        }

        return 0;
    }
}
