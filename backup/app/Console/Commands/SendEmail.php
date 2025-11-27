<?php

namespace App\Console\Commands;

use App\Mail\SubscriberMail;
use App\Models\BulkMail;
use App\Models\MailSetting;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-subscriber-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send subscribers email every minute';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('This Mail  Commend Start');
        Log::info(Carbon::now()->format('d-m-Y'));

        $email = BulkMail::take(config('app.send_mail'))->get();

        $mailData = MailSetting::first();
        $protocol = MailSetting::TYPE[$mailData->mail_protocol];
        $host = $mailData->mail_host;

        if ($mailData->mail_protocol == MailSetting::MAIL_LOG) {
            $protocol = 'log';
            $host = 'mailhog';
        }

        if ($mailData->mail_protocol == MailSetting::SMTP) {
            $protocol = 'smtp';
        }

        if ($mailData->mail_protocol == MailSetting::SENDGRID) {
            $protocol = 'sendgrid';
        }

        config([
            'mail.default' => $protocol,
            "mail.mailers.$protocol.transport" => $protocol,
            "mail.mailers.$protocol.host" => $host,
            "mail.mailers.$protocol.port" => $mailData->mail_port,
            "mail.mailers.$protocol.encryption" => MailSetting::ENCRYPTION_TYPE[$mailData->encryption],
            "mail.mailers.$protocol.username" => $mailData->mail_username,
            "mail.mailers.$protocol.password" => $mailData->mail_password,
            'mail.from.address' => $mailData->reply_to,
            'mail.from.name' => $mailData->mail_title,
        ]
        );

        foreach ($email as $data) {
            Mail::to($data->email)
                ->send(new SubscriberMail($data->body, $data->email, $data->subject));

            sleep(1);
            $data->delete();
        }

        Log::info('This Mail Commend End');
        Log::info(Carbon::now()->format('d-m-Y'));
    }
}
