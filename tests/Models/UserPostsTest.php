<?php


use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserPostsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_user_can_create_a_post_with_a_title_and_optional_description()
    {
        $user = factory(\App\User::class)->create();

        $post = $user->createPost('My Probing Test Post');
        $post2 = $user->createPost('A More Florid Post', 'Described in detail');

        $this->seeInDatabase('posts', [
            'id' => $post->id,
            'user_id' => $user->id,
            'title' => 'My Probing Test Post',
            'description' => null
        ]);

        $this->seeInDatabase('posts', [
            'id' => $post2->id,
            'user_id' => $user->id,
            'title' => 'A More Florid Post',
            'description' => 'Described in detail'
        ]);
    }
}