<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;

class JobSeeder extends Seeder
{
    public function run()
    {
        // Clear existing data first
        Job::truncate();

        // Your original jobs with added description field
        Job::create([
            'title' => 'Data Entry at Dashers',
            'category' => 'it',
            'job_type' => 'in-office',
            'working_hours' => 'morning',
            'location' => 'colombo 7',
            'pay_rate' => 'Weekly',
            'description' => 'Accurate data entry for logistics company'
        ]);

        Job::create([
            'title' => 'Marketing Intern',
            'category' => 'management',
            'job_type' => 'remote',
            'working_hours' => 'evening',
            'location' => 'colombo 5',
            'pay_rate' => 'Monthly',
            'description' => 'Assist marketing team with campaigns and social media'
        ]);

        Job::create([
            'title' => 'IT Support Assistant',
            'category' => 'it',
            'job_type' => 'remote',
            'working_hours' => 'night',
            'location' => 'remote',
            'pay_rate' => 'Hourly',
            'description' => 'Provide technical support to remote employees'
        ]);

        // Additional jobs to cover all filter combinations
        Job::create([
            'title' => 'Call Center Agent',
            'category' => 'call center',
            'job_type' => 'in-office',
            'working_hours' => 'evening',
            'location' => 'colombo 3',
            'pay_rate' => 'Hourly',
            'description' => 'Handle customer service calls for telecom company'
        ]);

        Job::create([
            'title' => 'Audit Associate',
            'category' => 'audit',
            'job_type' => 'in-office',
            'working_hours' => 'morning',
            'location' => 'colombo 1',
            'pay_rate' => 'Monthly',
            'description' => 'Assist with financial audits and compliance checks'
        ]);

        Job::create([
            'title' => 'Senior Software Engineer',
            'category' => 'it',
            'job_type' => 'remote',
            'working_hours' => 'morning',
            'location' => 'remote',
            'pay_rate' => 'Monthly',
            'description' => 'Develop and maintain web applications'
        ]);

        Job::create([
            'title' => 'Operations Manager',
            'category' => 'management',
            'job_type' => 'in-office',
            'working_hours' => 'morning',
            'location' => 'colombo 2',
            'pay_rate' => 'Monthly',
            'description' => 'Oversee daily business operations'
        ]);

        Job::create([
            'title' => 'Night Shift Supervisor',
            'category' => 'call center',
            'job_type' => 'in-office',
            'working_hours' => 'night',
            'location' => 'colombo 4',
            'pay_rate' => 'Weekly',
            'description' => 'Manage overnight call center team'
        ]);

        Job::create([
            'title' => 'Financial Auditor',
            'category' => 'audit',
            'job_type' => 'in-office',
            'working_hours' => 'morning',
            'location' => 'colombo 6',
            'pay_rate' => 'Monthly',
            'description' => 'Examine financial records for accuracy'
        ]);

        Job::create([
            'title' => 'IT Helpdesk Technician',
            'category' => 'it',
            'job_type' => 'in-office',
            'working_hours' => 'morning',
            'location' => 'colombo 8',
            'pay_rate' => 'Hourly',
            'description' => 'Provide first-line technical support'
        ]);
    }
}
