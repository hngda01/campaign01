<?php
  
namespace App\Jobs;
   
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\EmailForQueuing;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
   
class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
  
    protected $details;
  
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
   
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Mail::to('hngda01@gmail.com')->send(new EmailForQueuing());
        error_log('test queue 7');
        $to_name = 'Hai';
        $to_email = 'hngda01@gmail.com';
        $data = array('name'=>'Ogbonna Vitalis(sender_name)', 
                        'body' => 'A test mail'
        );
        Mail::send('email.register', $data, function($message) use ($to_name, $to_email)
            {
                $message->to($to_email, $to_name)->subject('Laravel Test Mail 2');
                $message->from('campaign.hanu@gmail.com','campaign.hanu@gmail.com');
            });

    }
}
