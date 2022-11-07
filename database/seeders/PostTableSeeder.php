<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $auther1 = User::create([
            'name' => 'Yaseen Mohammed',
            'email' => 'Yaseen@mail.com',
            'password' => Hash::make('12345678')
        ]);

        $auther2 = User::create([
            'name' => 'Menna Mohammed',
            'email' => 'Menna@mail.com',
            'password' => Hash::make('12345678')
        ]);

        $category1 = Category::create([
            'name' => 'News'
        ]);

        $category2 = Category::create([
            'name' => 'Marketing'
        ]);

        $category3= Category::create([
            'name' => 'Partnership'
        ]);

        $category4 = Category::create([
            'name' => 'Product'
        ]);

        $post1 = Post::create([
            'name' => 'We relocated our office to a new designed garage',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur doloribus',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio debitis, nesciunt praesentium deleniti adipisci, ipsum dolores porro sapiente ab voluptatibus eaque reprehenderit recusandae numquam hic tempore rem? Expedita, quas a?',
            'category_id' => $category1->id,
            'image' => 'posts/1.jpg',
            'user_id' => $auther1->id,
            'published_at' => now(),
        ]);

        $post2 = $auther2->posts()->create([
            'name' => 'Top 5 brilliant content marketing strategies',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur doloribus',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio debitis, nesciunt praesentium deleniti adipisci, ipsum dolores porro sapiente ab voluptatibus eaque reprehenderit recusandae numquam hic tempore rem? Expedita, quas a?',
            'category_id' => $category2->id,
            'image' => 'posts/2.jpg',
            'published_at' => now(),

        ]);

        $post3 = $auther1->posts()->create([
            'name' => 'Best practices for minimalist design with example',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur doloribus',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio debitis, nesciunt praesentium deleniti adipisci, ipsum dolores porro sapiente ab voluptatibus eaque reprehenderit recusandae numquam hic tempore rem? Expedita, quas a?',
            'category_id' => $category3->id,
            'image' => 'posts/3.jpg',
            'published_at' => now(),
        ]);


        $post4 = $auther2->posts()->create([
            'name' => 'Congratulate and thank to Maryam for joining our team',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur doloribus',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio debitis, nesciunt praesentium deleniti adipisci, ipsum dolores porro sapiente ab voluptatibus eaque reprehenderit recusandae numquam hic tempore rem? Expedita, quas a?',
            'category_id' => $category4->id,
            'image' => 'posts/4.jpg',
            'published_at' => now(),

        ]);

        $tag1 = Tag::create([
            'name' => 'job'
        ]);

        $tag2 = Tag::create([
            'name' => 'customers'
        ]);

        $tag3 = Tag::create([
            'name' => 'record'
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag2->id, $tag3->id]);
        $post3->tags()->attach([$tag1->id, $tag3->id]);
        $post4->tags()->attach([$tag2->id, $tag1->id]);
    }

}
