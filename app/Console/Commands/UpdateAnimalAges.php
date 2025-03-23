<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Animal;
use Carbon\Carbon;

class UpdateAnimalAges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:update-animal-ages';
    protected $signature = 'animals:update-age';
    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';
    protected $description = 'Update animal ages every month based on created_at date';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $animals = Animal::whereNotNull('created_at')->whereNotNull('age')->get();
        
        foreach ($animals as $animal) {
            $currentAge = trim($animal->age);
            $createdAt = Carbon::parse($animal->created_at);
            $now = Carbon::now();
            
            $years = 0;
            $months = 0;
            
            // Check if the string contains Arabic text for month (شهر)
            if (is_numeric($currentAge) && strpos($currentAge, 'شهر') !== false) {
                // It's "X شهر" format (Arabic month)
                $months = (int)preg_replace('/[^0-9]/', '', $currentAge);
            } else if (is_numeric($currentAge)) {
                // If age is just a number (e.g., "2"), assume it's years
                $years = (int)$currentAge;
            } else {
                // Parse age if already in "X years, Y months" format
                $parsedAge = $this->parseAge($currentAge);
                if ($parsedAge) {
                    $years = $parsedAge['years'];
                    $months = $parsedAge['months'];
                }
            }
            
            // Add one month
            $months += 1;
            if ($months >= 12) {
                $years++;
                $months = 0;
            }
            
            $newAge = $this->formatAge($years, $months);
            
            // Update the database only if the value has changed
            if ($animal->age !== $newAge) {
                $animal->update(['age' => $newAge]);
                $this->info("Updated Animal ID {$animal->id} → {$newAge}");
            }
        }
        
        $this->info('All animal ages updated successfully!');
    }
    
    /**
     * Parses age from "X years, Y months" format
     * Also handles Arabic month format
     */
    private function parseAge($ageString)
    {
        $years = 0;
        $months = 0;
        
        // Check for Arabic month format
        if (strpos($ageString, 'شهر') !== false) {
            $numericPart = preg_replace('/[^0-9]/', '', $ageString);
            if (is_numeric($numericPart)) {
                $months = (int)$numericPart;
                return ['years' => 0, 'months' => $months];
            }
        }
        
        // Handle English format
        if (preg_match('/(\d+)\s*years?/', $ageString, $matches)) {
            $years = (int)$matches[1];
        }
        
        if (preg_match('/(\d+)\s*months?/', $ageString, $matches)) {
            $months = (int)$matches[1];
        }
        
        return ['years' => $years, 'months' => $months];
    }
    
    /**
     * Formats the age correctly
     */
    private function formatAge($years, $months)
    {
        $ageString = '';
        
        if ($years > 0) {
            $ageString .= $years . ' ' . ($years == 1 ? __('year') : __('years'));
        }
        
        if ($months > 0) {
            if (!empty($ageString)) {
                $ageString .= ', ';
            }
            $ageString .= $months . ' ' . ($months == 1 ? __('month') : __('months'));
        }
        
        return $ageString ?: '0 months'; // Default if both are 0
    }
}
