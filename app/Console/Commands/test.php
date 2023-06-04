<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Atymic\Twitter\Facade\Twitter;
use Atymic\Twitter\Exception\TwitterException;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $tweets = Twitter::getUserTimeline([
                'screen_name' => 'Melarc_ab',
                'count' => 1,
                'format' => 'json'
            ]);

            $latestTweet = $tweets;

            echo json_encode($latestTweet);
        } catch (TwitterException $e) {
            echo json_encode([
                "error" => $e->getMessage()
            ]);
            // Puedes reemplazar esto con tu método preferido de registro
            error_log($e->getMessage());
        }
    }
}
