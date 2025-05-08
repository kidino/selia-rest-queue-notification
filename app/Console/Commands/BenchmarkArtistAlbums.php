<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Artist;

class BenchmarkArtistAlbums extends Command
{
    protected $signature = 'chinook:benchmark-artists';

    protected $description = 'Process all artists, their albums and tracks, and compute total duration';

    public function handle()
    {
        $this->info('Starting benchmark...');

        $start = microtime(true);

        $artists = Artist::all();

        foreach ($artists as $artist) {
            $totalDuration = 0;

            foreach ($artist->albums as $album) {
                foreach ($album->tracks as $track) {
                    // Simulate some processing
                    // usleep(1000); // 1ms per track
                    $totalDuration += $track->milliseconds;
                }
            }

            $durationInSeconds = round($totalDuration / 1000, 2);

            $this->line("Artist: {$artist->name} | Total Duration: {$durationInSeconds} sec");
        }

        $elapsed = round(microtime(true) - $start, 2);
        $this->info("Finished in {$elapsed} seconds.");
    }
}

