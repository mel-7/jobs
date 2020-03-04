<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new \App\Post([
            'position'  => 'Chef',
            'slug'      => 'chef',
            'content'   => 'Short Descrption',
            'status'    => 1,
            'author'    => 1,
            'company'   => 1
        ]);
        $post->save();
        $post = new \App\Post([
            'position'  => 'CEO',
            'slug'      => 'ceo',
            'content'   => 'Short Descrption',
            'status'    => 1,
            'author'    => 1,
            'company'   => 1
        ]);
        $post->save();
        $post = new \App\Post([
            'position'  => 'CFO',
            'slug'      => 'cfo',
            'content'   => 'Short Descrption',
            'status'    => 1,
            'author'    => 1,
            'company'   => 1
        ]);
        $post->save();
        $post = new \App\Post([
            'position'  => 'Grandiose Staff',
            'slug'      => 'grandiose-staff',
            'content'   => 'Short Descrption',
            'status'    => 1,
            'author'    => 1,
            'company'   => 3
        ]);
        $post->save();
        $post = new \App\Post([
            'position'  => 'Sales',
            'slug'      => 'sales',
            'content'   => 'Short Descrption',
            'status'    => 1,
            'author'    => 1,
            'company'   => 4
        ]);
        $post->save();
    }
}
