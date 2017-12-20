<?php

namespace App\Jobs;

use PhpSms;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendVerifyCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $phone;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $code = rand(1000,9999);
        \Cache::put($this->phone, $code, 10);
        $content = "您的验证码为".$code."有效期为10分钟";
        $templates = [
          'Yunpian' => env('YUNPIAN_TEMPLATE_VERIFYCODE_ID','123456'),
        ];
        $templateData = [
            'code' => $code
        ];
        PhpSms::make()->to($this->phone)->template($templates)->data($templateData)->content($content)->send();

    }
}
