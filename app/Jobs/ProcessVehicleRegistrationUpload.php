<?php

namespace App\Jobs;

use App\Models\VehicleRegistration;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessVehicleRegistrationUpload implements ShouldQueue
{
    use Queueable;

    protected $filePath;

    /**
     * Create a new job instance.
     */
    public function __construct( $filePath )
    {
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $handle = fopen(Storage::path($this->filePath), 'r');

            Log::info('CSV import started: ' . $this->filePath);

            if($handle === false) {
                throw new \Exception('cannot open file '. $this->filePath);
            } 

            $headers = fgetcsv($handle);

            $counter = 0;
            while( ($row = fgetcsv($handle) ) !== false) {
                echo "[" . ++$counter ."] - " . implode(" | ", $row) . "\n";

                if(count($row) === 7) {
                    VehicleRegistration::create([
                        'date_reg' => $row[0],
                        'type' => $row[1],
                        'maker' => $row[2],
                        'model' => $row[3],
                        'colour' => $row[4],
                        'fuel' => $row[5],
                        'state' => $row[6],
                    ]);
                }
            }

            fclose($handle);
            Storage::delete( $this->filePath );

        } catch(\Exception $e) {

        }
    }
}
