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
            'title'  => 'Chef',
            'slug'      => 'chef',
            'description'   => null,
            'status'    => true,
            'author'    => 1
        ]);
        $post->save();
        $post = new \App\Post([
            'title'  => 'CEO',
            'slug'      => 'ceo',
            'description'   => null,
            'status'    => true,
            'author'    => 1
        ]);
        $post->save();
        $post = new \App\Post([
            'title'  => 'CFO',
            'slug'      => 'cfo',
            'description'   => null,
            'status'    => true,
            'author'    => 1
        ]);
        $post->save();
        $post = new \App\Post([
            'title'  => 'Grandiose Staff',
            'slug'      => 'grandiose-staff',
            'description'   => null,
            'status'    => true,
            'author'    => 1
        ]);
        $post->save();
        $post = new \App\Post([
            'title'  => 'Sales',
            'slug'      => 'sales',
            'description'   => null,
            'status'    => true,
            'author'    => 1
        ]);
        $post->save();
    }
}
