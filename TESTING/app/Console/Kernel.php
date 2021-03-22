<?php

namespace App\Console;

use App\Models\admin\Voucher;
use App\Models\admin\VoucherReedemed;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->call(function () {

            $excel_array = array();

            $current_date = Carbon::now()->format('Y-m-d');
            $gift_clamied = VoucherReedemed::where(DB::raw('DATE(created_at)'), $current_date)->get();

//            if(!empty($gift_clamied)) {
                foreach ($gift_clamied as $gc) {
                    $userData = User::find($gc->user_id);
                    $giftTitle = Voucher::find($gc->voucher_id);

                    $excel_array[] = array(
                        'username' => $userData->username,
                        'phone_number' =>$userData->phone_number,
                        'cpf_number' => $userData->cpf_number,
                        'email' =>$userData->email,
                        'title' => $giftTitle->title,
                        'points_requested' => $gc->points_requested,
                        'Quantity' => 1,
                        'MIDIA' => 'O97 DIGGY TECH',
                        'payment_method'=>'022',
                    );
                }

                Excel::create('gift_voucher', function ($excel) use ($excel_array) {

                    $excel->sheet('sheet1', function ($sheet) use ($excel_array) {
                        $sheet->fromArray($excel_array);
                    });

                })->store("xlsx", storage_path());

                //send stored file
                $mime = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
                $display = 'dasas';
                Mail::send('emails.test',["data"=>""],function($m){
                    $m->from('anuva.kataria@imarkinfotech.com');
                    $m->to('anuva.kataria@imarkinfotech.com')->subject('Gift Redeemed | '.Carbon::now()->format('M d Y'));
                    $m->attach('http://68.183.74.38:8008/joao/storage/gift_voucher.xlsx');
                });
//            }
        })->everyMinute();

        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
