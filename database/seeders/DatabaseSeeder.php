<?php

namespace Database\Seeders;

use App\Category;
use App\Course;
use App\Lesson;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    private const LESSON_TITLES = [
        'Welcome: outcomes and how to use this course',
        'Setup: tools, accounts, and your first exercise',
        'Core concepts: vocabulary, patterns, and mental models',
        'Hands-on: guided practice from start to finish',
        'Wrap-up: resources, checklist, and what to learn next',
    ];

    private const LESSON_VIDEOS = [
        'https://www.youtube.com/watch?v=PkZNo7MFNFg',
        'https://www.youtube.com/watch?v=rfscVS0vtbw',
        'https://www.youtube.com/watch?v=8DvywoWv6fI',
        'https://www.youtube.com/watch?v=HGTJBPNC-Gw',
        'https://www.youtube.com/watch?v=1PnVor36_40',
    ];

    private const FIRST_NAMES = [
        'James', 'Mary', 'Robert', 'Patricia', 'John', 'Jennifer', 'Michael', 'Linda',
        'David', 'Elizabeth', 'William', 'Barbara', 'Richard', 'Susan', 'Joseph', 'Jessica',
        'Thomas', 'Sarah', 'Christopher', 'Karen', 'Daniel', 'Lisa', 'Matthew', 'Nancy',
        'Anthony', 'Betty', 'Mark', 'Margaret', 'Donald', 'Sandra', 'Steven', 'Ashley',
        'Andrew', 'Kimberly', 'Paul', 'Emily', 'Joshua', 'Donna', 'Kenneth', 'Michelle',
        'Kevin', 'Carol', 'Brian', 'Amanda', 'George', 'Dorothy', 'Timothy', 'Melissa',
        'Ronald', 'Deborah', 'Jason', 'Stephanie', 'Edward', 'Rebecca', 'Jeffrey', 'Sharon',
        'Ryan', 'Laura', 'Jacob', 'Cynthia', 'Gary', 'Kathleen', 'Nicholas', 'Amy',
        'Eric', 'Shirley', 'Jonathan', 'Angela', 'Stephen', 'Helen', 'Larry', 'Anna',
        'Justin', 'Brenda', 'Scott', 'Pamela', 'Brandon', 'Nicole', 'Benjamin', 'Emma',
        'Samuel', 'Samantha', 'Frank', 'Katherine', 'Gregory', 'Christine', 'Raymond', 'Debra',
        'Alexander', 'Rachel', 'Patrick', 'Catherine', 'Jack', 'Carolyn', 'Dennis', 'Janet',
        'Jerry', 'Ruth', 'Tyler', 'Maria', 'Aaron', 'Heather',
    ];

    private const LAST_NAMES = [
        'Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis',
        'Rodriguez', 'Martinez', 'Hernandez', 'Lopez', 'Gonzalez', 'Wilson', 'Anderson', 'Thomas',
        'Taylor', 'Moore', 'Jackson', 'Martin', 'Lee', 'Perez', 'Thompson', 'White',
        'Harris', 'Sanchez', 'Clark', 'Ramirez', 'Lewis', 'Robinson', 'Walker', 'Young',
        'Allen', 'King', 'Wright', 'Scott', 'Torres', 'Nguyen', 'Hill', 'Flores',
        'Green', 'Adams', 'Nelson', 'Baker', 'Hall', 'Rivera', 'Campbell', 'Mitchell',
        'Carter', 'Roberts', 'Gomez', 'Phillips', 'Evans', 'Turner', 'Diaz', 'Parker',
        'Cruz', 'Edwards', 'Collins', 'Reyes', 'Stewart', 'Morris', 'Morales', 'Murphy',
        'Cook', 'Rogers', 'Gutierrez', 'Ortiz', 'Morgan', 'Cooper', 'Peterson', 'Bailey',
        'Reed', 'Kelly', 'Howard', 'Ramos', 'Kim', 'Cox', 'Ward', 'Richardson',
        'Watson', 'Brooks', 'Chavez', 'Wood', 'James', 'Bennett', 'Gray', 'Mendoza',
        'Ruiz', 'Hughes', 'Price', 'Alvarez', 'Castillo', 'Sanders', 'Patel', 'Myers',
        'Long', 'Ross', 'Foster', 'Jimenez', 'Powell', 'Jenkins', 'Perry', 'Russell',
        'Sullivan', 'Bell', 'Coleman', 'Butler', 'Henderson', 'Barnes', 'Gonzales', 'Fisher',
        'Vasquez', 'Simmons', 'Romero', 'Jordan', 'Patterson', 'Alexander', 'Hamilton', 'Graham',
        'Reynolds', 'Griffin', 'Wallace', 'Moreno', 'West', 'Cole', 'Hayes', 'Bryant',
        'Herrera', 'Gibson', 'Ellis', 'Tran', 'Medina', 'Aguilar', 'Stevens', 'Murray',
        'Ford', 'Castro', 'Marshall', 'Owens', 'Harrison', 'Fernandez', 'Mcdonald', 'Woods',
        'Washington', 'Kennedy', 'Wells', 'Vargas', 'Henry', 'Chen', 'Freeman', 'Webb',
        'Tucker', 'Guzman', 'Burns', 'Crawford', 'Olson', 'Simpson', 'Porter', 'Hunter',
        'Gordon', 'Mendez', 'Silva', 'Shaw', 'Snyder', 'Mason', 'Dixon', 'Munoz',
        'Hunt', 'Hicks', 'Holmes', 'Palmer', 'Wagner', 'Black', 'Robertson', 'Boyd',
        'Rose', 'Stone', 'Salazar', 'Fox', 'Warren', 'Mills', 'Meyer', 'Rice',
        'Schmidt', 'Garza', 'Daniels', 'Ferguson', 'Nichols', 'Stephens', 'Soto', 'Weaver',
        'Ryan', 'Gardner', 'Payne', 'Grant', 'Dunn', 'Kelley', 'Spencer', 'Hawkins',
        'Arnold', 'Pierce', 'Vazquez', 'Hansen', 'Peters', 'Santos', 'Hart', 'Bradley',
        'Knight', 'Elliott', 'Cunningham', 'Duncan',
    ];

    private const LEVELS = ['Beginner', 'Intermediate', 'Advanced'];

    private const PRICES = [29.99, 39.99, 44.99, 49.99, 59.99, 69.99, 79.99, 89.99, 99.99];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $catalog = require database_path('data/learning_catalog.php');

        $this->seedUsers();
        $categoryIdsByTitle = $this->seedCategories($catalog);
        $this->seedCoursesAndLessons($catalog, $categoryIdsByTitle);
    }

    private function seedUsers(): void
    {
        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        for ($i = 0; $i < 99; $i++) {
            $first = self::FIRST_NAMES[$i % count(self::FIRST_NAMES)];
            $last = self::LAST_NAMES[$i % count(self::LAST_NAMES)];
            $email = Str::lower(Str::slug($first.'.'.$last.'-'.$i)).'@learn.example.com';

            User::factory()->create([
                'first_name' => $first,
                'last_name' => $last,
                'email' => $email,
            ]);
        }
    }

    /**
     * @param  array<string, array<int, string>>  $catalog
     * @return array<string, int>
     */
    private function seedCategories(array $catalog): array
    {
        $map = [];
        foreach (array_keys($catalog) as $title) {
            $category = Category::query()->create([
                'title' => $title,
                'slug' => Str::slug($title),
            ]);
            $map[$title] = $category->id;
        }

        return $map;
    }

    /**
     * @param  array<string, array<int, string>>  $catalog
     * @param  array<string, int>  $categoryIdsByTitle
     */
    private function seedCoursesAndLessons(array $catalog, array $categoryIdsByTitle): void
    {
        $courseIndex = 0;

        foreach ($catalog as $categoryTitle => $titles) {
            $categoryId = $categoryIdsByTitle[$categoryTitle];

            foreach ($titles as $title) {
                $fields = $this->realisticCourseFields($title, $categoryTitle, $courseIndex);
                $course = Course::query()->create(array_merge($fields, [
                    'title' => $title,
                    'category_id' => $categoryId,
                ]));

                foreach (self::LESSON_TITLES as $lessonNum => $lessonTitle) {
                    Lesson::query()->create([
                        'course_id' => $course->id,
                        'title' => $lessonTitle,
                        'duration' => sprintf('%.1f', 10 + ($lessonNum * 2.5) + ($courseIndex % 6)),
                        'video' => self::LESSON_VIDEOS[$lessonNum % count(self::LESSON_VIDEOS)],
                    ]);
                }

                $courseIndex++;
            }
        }
        // 20 × 5 = 100 courses, each with 5 lessons
    }

    private function realisticCourseFields(string $title, string $categoryName, int $index): array
    {
        $level = self::LEVELS[$index % count(self::LEVELS)];
        $price = self::PRICES[$index % count(self::PRICES)];

        $req = $level === 'Advanced'
            ? 'Comfort with the fundamentals in this topic; Completion of an introductory course or equivalent experience is recommended.'
            : 'A computer with internet access; willingness to follow step-by-step exercises; no paid software required unless noted in the first lesson.';

        return [
            'short_description' => "Learn {$title} through clear lessons and practical exercises. Build real skills you can use in {$categoryName} projects right away.",
            'description' => "This course is a structured path through {$title} inside the {$categoryName} track. You will see how each idea fits into a real workflow, practice with short assignments, and finish with a concrete set of notes and resources you can return to later. Lessons are designed to be completed in order, but you can revisit sections when you need a refresher.",
            'outcomes' => 'Explain the core ideas of this topic in your own words; complete the guided exercises without copying blindly; know where to look next when requirements change; avoid common pitfalls called out in each section.',
            'section' => "Module 1 — Orientation and setup\nModule 2 — Foundations and vocabulary\nModule 3 — Core techniques with examples\nModule 4 — Guided practice project\nModule 5 — Review, checklist, and next steps",
            'requirements' => $req,
            'language' => 'English',
            'price' => $price,
            'level' => $level,
            'thumbnail' => 'https://picsum.photos/seed/'.md5($categoryName.'|'.$title).'/640/360',
            'video_url' => null,
            'visibility' => true,
        ];
    }
}
