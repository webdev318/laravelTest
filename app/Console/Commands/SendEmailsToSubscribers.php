<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Notifications\NewPostCreatedNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendEmailsToSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:subscribers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify the subscribers of the posts.';

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
        Post::with('website.subscribers')
            ->latest()
            ->chunkById(100, function ($posts) {
                foreach ($posts as $post) {
                    Notification::send($post->website->subscribers, new NewPostCreatedNotification($post));
                }
            });

        return Command::SUCCESS;
    }
}
