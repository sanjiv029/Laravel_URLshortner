<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\UrlCreatedMarkdownMail;
use Illuminate\Support\Facades\Mail;
use App\Models\URL;
use App\Models\User;
class SendUrlCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public User $user, public URL $url)
    {

    }

    public function handle(): void
    {
        Mail::to($this->user->email)->send(new UrlCreatedMarkdownMail($this->url));
    }
}
