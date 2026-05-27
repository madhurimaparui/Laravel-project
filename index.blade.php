<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * DatabaseSeeder
 * COURSE: Database seeding - populate dummy data
 * Run: php artisan db:seed
 * Or: php artisan migrate --seed
 */
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        $admin = User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@laravelcms.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Create regular user
        $user = User::create([
            'name'     => 'John Doe',
            'email'    => 'john@example.com',
            'password' => Hash::make('password'),
            'role'     => 'user',
        ]);

        // Create categories
        $categories = collect([
            ['name' => 'Laravel',      'description' => 'All about the Laravel framework'],
            ['name' => 'PHP',          'description' => 'Core PHP tips and tutorials'],
            ['name' => 'JavaScript',   'description' => 'Frontend and Node.js content'],
            ['name' => 'Web Design',   'description' => 'CSS, HTML, and design topics'],
            ['name' => 'Databases',    'description' => 'MySQL, Eloquent, and more'],
        ])->map(fn($c) => Category::create([
            'name'        => $c['name'],
            'slug'        => Str::slug($c['name']),
            'description' => $c['description'],
        ]));

        // Create tags
        $tags = collect(['eloquent', 'routing', 'blade', 'auth', 'crud', 'migration', 'api', 'testing'])
            ->map(fn($t) => Tag::create(['name' => $t, 'slug' => Str::slug($t)]));

        // Create sample posts
        $samplePosts = [
            ['title' => 'Getting Started with Laravel', 'category' => 0, 'tags' => [0, 1]],
            ['title' => 'Understanding Eloquent ORM',   'category' => 0, 'tags' => [0, 5]],
            ['title' => 'Laravel Blade Templating',     'category' => 0, 'tags' => [2]],
            ['title' => 'Laravel Authentication Guide', 'category' => 0, 'tags' => [3]],
            ['title' => 'PHP 8 New Features',           'category' => 1, 'tags' => []],
            ['title' => 'MySQL with Laravel Migrations','category' => 4, 'tags' => [5, 0]],
        ];

        foreach ($samplePosts as $p) {
            $post = Post::create([
                'title'        => $p['title'],
                'slug'         => Str::slug($p['title']) . '-' . uniqid(),
                'excerpt'      => 'This is an excerpt for ' . $p['title'] . '. Learn everything you need to know.',
                'body'         => '<p>This is the full body content for <strong>' . $p['title'] . '</strong>.</p><p>In this post we will explore key concepts and practical examples to help you master the topic. Laravel makes complex tasks simple and enjoyable.</p><p>Keep learning and building amazing things!</p>',
                'is_published' => true,
                'user_id'      => $admin->id,
                'category_id'  => $categories[$p['category']]->id,
            ]);

            // Attach tags (many-to-many)
            $post->tags()->sync(collect($p['tags'])->map(fn($i) => $tags[$i]->id));
        }

        $this->command->info('✅ Database seeded! Login: admin@laravelcms.com / password');
    }
}
