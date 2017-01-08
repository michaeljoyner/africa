<?php


use App\Blog\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostsSlugTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_posts_slug_does_update_if_the_post_has_never_been_published()
    {
        $post = factory(Post::class)->create();
        $originalSlug = $post->slug;

        $post->title = 'A new post and a new slug';
        $post->save();

        $this->assertNotEquals($originalSlug, $post->fresh()->slug);
    }

    /**
     *@test
     */
    public function a_posts_slug_does_not_once_once_it_has_been_published()
    {
        $post = factory(Post::class)->create(['published_on' => \Carbon\Carbon::yesterday()]);
        $originalSlug = $post->slug;

        $post->title = 'A new post but not a new slug';
        $post->save();

        $this->assertEquals($originalSlug, $post->fresh()->slug);
    }
}