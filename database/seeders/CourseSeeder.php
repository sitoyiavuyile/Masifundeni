<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrolment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Get existing instructor or create one ──────────────────────────
        $instructor = User::where('role', 'instructor')->first()
            ?? User::factory()->create([
                'name'  => 'Default Instructor',
                'email' => 'instructor2@sms.test',
                'role'  => 'instructor',
            ]);

        // ── Create a set of predictable, hand-crafted courses ─────────────
        $courses = [
            [
                'code'        => 'CS101',
                'title'       => 'Introduction to Computer Science',
                'description' => 'Fundamentals of programming, algorithms, and data structures.',
                'status'      => 'published',
                'credits'     => 3,
            ],
            [
                'code'        => 'DB201',
                'title'       => 'Database Systems',
                'description' => 'Relational databases, SQL, normalisation, and query optimisation.',
                'status'      => 'published',
                'credits'     => 3,
            ],
            [
                'code'        => 'WD301',
                'title'       => 'Web Development',
                'description' => 'Modern web development with Laravel and Vue.js.',
                'status'      => 'published',
                'credits'     => 4,
            ],
            [
                'code'        => 'AI401',
                'title'       => 'Artificial Intelligence',
                'description' => 'Machine learning, neural networks, and AI ethics.',
                'status'      => 'draft',
                'credits'     => 4,
            ],
        ];

        foreach ($courses as $data) {
            Course::firstOrCreate(
                ['code' => $data['code']],
                array_merge($data, ['instructor_id' => $instructor->id])
            );
        }

        // ── Random extra courses via factory ──────────────────────────────
        Course::factory()
            ->count(6)
            ->forInstructor($instructor)
            ->published()
            ->create();

        // ── Enrol existing students into published courses ─────────────────
        $students        = User::where('role', 'student')->get();
        $publishedCourses = Course::published()->get();

        $students->each(function (User $student) use ($publishedCourses) {
            // Enrol each student in 2-3 random courses
            $publishedCourses->random(min(rand(2, 3), $publishedCourses->count()))
                ->each(function (Course $course) use ($student) {
                    Enrolment::firstOrCreate(
                        ['student_id' => $student->id, 'course_id' => $course->id],
                        ['status' => 'active', 'enrolled_at' => now()]
                    );
                });
        });

        $this->command->info('Courses & enrolments seeded successfully.');
    }
}
