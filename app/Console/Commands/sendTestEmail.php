<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Mail;

class sendTestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Just send a test email';

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
        Mail::raw('Αυτό είναι ένα σημαντικό μήνυμα.', function ($message) {
            
            $message->from('info@eduwebawards.gr');
            $message->to('chralatz@gmail.com');
            $message->subject('Σημαντικό μήνυμα');

        });

    }
}
