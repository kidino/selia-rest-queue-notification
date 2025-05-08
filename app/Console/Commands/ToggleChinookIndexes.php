<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ToggleChinookIndexes extends Command
{
    protected $signature = 'chinook:toggle-indexes {action : add or remove}';

    protected $description = 'Add or remove indexes on Chinook foreign key columns for benchmark demo';

    public function handle()
    {
        $action = $this->argument('action');

        if (!in_array($action, ['add', 'remove'])) {
            $this->error("Invalid action. Use 'add' or 'remove'.");
            return 1;
        }

        if ($action === 'add') {
            $this->addIndexes();
        } else {
            $this->removeIndexes();
        }

        return 0;
    }

    protected function addIndexes()
    {
        $this->info('Adding indexes...');

        DB::statement('CREATE INDEX idx_albums_artist_id ON albums(artist_id)');
        DB::statement('CREATE INDEX idx_tracks_album_id ON tracks(album_id)');

        $this->info('Indexes added successfully.');
    }

    protected function removeIndexes()
    {
        $this->info('Removing indexes...');

        DB::statement('DROP INDEX idx_albums_artist_id ON albums');
        DB::statement('DROP INDEX idx_tracks_album_id ON tracks');

        $this->info('Indexes removed successfully.');
    }
}
