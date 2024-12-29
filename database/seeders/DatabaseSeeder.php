<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $therapyTopics = [
            'Anxiety',
            'Depression',
            'Relationship issues',
            'Stress management',
            'Self-esteem and confidence',
            'Trauma and PTSD',
            'Grief and loss',
            'Anger management',
            'Substance abuse',
            'Eating disorders',
            'Phobias',
            'Obsessive-compulsive disorder (OCD)',
            'Family conflicts',
            'Work-related stress',
            'Identity and self-discovery',
            'Loneliness and social isolation',
            'Childhood experiences',
            'Sexual problems',
            'Life transitions',
            'Bipolar disorder',
            'Panic attacks',
            'Insomnia and sleep issues',
            'Body image concerns',
            'Perfectionism',
            'Guilt and shame',
        ];

        foreach ($therapyTopics as $topic) {
            $subject = new Subject();

            $subject->name = $topic;
            $subject->slug = Str::slug($topic);
            $subject->save();
        }
    }
}
