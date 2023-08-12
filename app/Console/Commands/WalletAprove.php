<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class WalletAprove extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wallet:approve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To update wallet status active after 24 hours';

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
        $wallet_data = DB::table('wallets')->where('status','P')->get();
        // dd($wallet_data);
        foreach ($wallet_data as $value) {
            $created_time = $value->created_at;
           $approval_time = date('Y-m-d H:i:s', strtotime("+1 days".$created_time));
           $present_time = date('Y-m-d H:i:s');
        //    dd($approval_time,$present_time);

           if (strtotime($present_time)  >= strtotime($approval_time)) {
            // dd('now you can update');
            $wallet_data_update = DB::table('wallets')->where('id',$value->id)
            ->update(['status'=>"A"]);
           }
        }

    }
}
