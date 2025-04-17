<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AllowedStudent;

class ImportStudentData extends Command
{
    protected $signature = 'import:student-data {file}';
    protected $description = 'Import student data from JSON file';

    public function handle()
    {
        $file = storage_path('app/' . ltrim($this->argument('file'), '/')); // Ensure correct path

        // Debugging: Print the actual path being checked
        $this->info("Looking for file at: $file");

        if (!file_exists($file)) { // ✅ FIX: Use file_exists() instead of Storage::exists()
            $this->error("File not found: $file");
            return 1;
        }

        $data = json_decode(file_get_contents($file), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Invalid JSON format: ' . json_last_error_msg());
            return 1;
        }

        $count = 0;

        foreach ($data as $student) {
            if (!isset($student['student_id'])) {
                $this->warn('Skipping record missing student_id');
                continue;
            }

            AllowedStudent::updateOrCreate(
                ['student_id' => $student['student_id']],
                [
                    'first_name' => $student['first_name'] ?? null,
                    'last_name' => $student['last_name'] ?? null
                ]
            );

            $count++;
        }

        $this->info("Successfully imported $count student records!");
        return 0;
    }
}
