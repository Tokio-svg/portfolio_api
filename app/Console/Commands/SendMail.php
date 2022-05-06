<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendReminderMail;
use App\Models\Contact;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder email.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $new_number = Contact::where('read_flag', false)->count();

        if ($new_number > 0) {
            $data = [ 'number' => $new_number];
            Mail::to('re_zell@yahoo.co.jp')->send(new SendReminderMail($data));
        }
    }
}
