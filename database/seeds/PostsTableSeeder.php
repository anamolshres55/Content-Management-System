<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;


use App\Post;

use App\Category;

use App\Tag;

use App\User;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    $author1 = App\User::create([
        'name' => 'John Doe',
        'email' => 'john@doe.com',
        'password' => Hash::make('password')
    ]);

    $author2 = App\User::create([
        'name' => 'Jone Doe',
        'email' => 'jone@doe.com',
        'password' => Hash::make('password')
    ]);

    $author3 = App\User::create([
        'name' => 'Johnee Doe',
        'email' => 'johnee@doe.com',
        'password' => Hash::make('password')
    ]);

        
    $category1 = Category::create([
        'name' => 'News'
    ]);

    $category2 = Category::create([
        'name' => 'Marketing'
    ]);
    
    $category3 = Category::create([
        'name' => 'Partnership'
    ]);
    
    $category4 = Category::create([
        'name' => 'Updates'
    ]);
    
    $category5 = Category::create([
        'name' => 'Design'
    ]);

    $tag1 = Tag::create([
        'name' => 'Job'
    ]);

    $tag2 = Tag::create([
        'name' => 'Customer'
    ]);

    $tag3 = Tag::create([
        'name' => 'Version'
    ]);


        $post1 = Post::create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'We relocated our office to a new designed garage',
            'content' => 'We relocated our office to a new designed garageWe relocated our office to a new designed garageWe relocated our office to a new designed garage',
            'category_id' => $category1->id,
            'image' => 'posts/1.jpg',
            'user_id' => $author1->id

        ]);

        $post2 = $author1->post()->create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'description' => 'We relocated our office to a new designed garage',
            'content' => 'We relocated our office to a new designed garageWe relocated our office to a new designed garageWe relocated our office to a new designed garage',
            'category_id' => $category2->id,
            'image' => 'posts/2.jpg'
        ]);

        $post3 = $author2->post()->create([
            'title' => 'Best practices for minimalist design with example',
            'description' => 'We relocated our office to a new designed garage',
            'content' => 'We relocated our office to a new designed garageWe relocated our office to a new designed garageWe relocated our office to a new designed garage',
            'category_id' => $category3->id,
            'image' => 'posts/3.jpg'
        ]);

        
        $post4 = $author3->post()->create([
            'title' => 'Congratulate and thank to Maryam for joining our team',
            'description' => 'We relocated our office to a new designed garage',
            'content' => 'We relocated our office to a new designed garageWe relocated our office to a new designed garageWe relocated our office to a new designed garage',
            'category_id' => $category4->id,
            'image' => 'posts/4.jpg'
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);

        $post2->tags()->attach([$tag2->id, $tag3->id]);

        $post3->tags()->attach([$tag1->id, $tag3->id]);

    }
}
