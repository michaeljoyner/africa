<?php


use App\Blog\Post;
use App\Events\PostFirstPublished;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_post_can_be_created_and_persisted()
    {
        $post = factory(App\Blog\Post::class)->create();

        $this->assertInstanceOf(App\Blog\Post::class, $post);
    }

    /**
     *@test
     */
    public function a_posts_body_may_be_set()
    {
        $post = factory(Post::class)->create();

        $post = $post->setBody('A whole new body');

        $this->assertEquals('A whole new body', $post->body);

        $this->seeInDatabase('posts', [
            'id' => $post->id,
            'body' => 'A whole new body'
        ]);
    }

    /**
     *@test
     */
    public function a_post_may_be_published()
    {
        $post = factory(Post::class)->create(['published' => false]);

        $post->publish();

        $this->assertTrue($post->published);
    }

    /**
     *@test
     */
    public function a_post_may_be_retracted()
    {
        $post = factory(Post::class)->create(['published' => true]);

        $post->retract();

        $this->assertFalse($post->published);
    }

    /**
     *@test
     */
    public function a_posts_published_on_date_is_set_when_it_is_first_published()
    {
        $post = factory(Post::class)->create(['published' => false]);
        $this->assertNull($post->published_on);

        $post->publish();
        $this->assertNotNull($post->published_on);
        $this->assertTrue($post->published_on->isToday());
    }

    /**
     *@test
     */
    public function a_post_being_republished_does_not_have_its_published_on_date_reset()
    {
        $post = factory(Post::class)->create(['published' => false, 'published_on' => \Carbon\Carbon::yesterday()]);

        $post->retract();

        $this->assertTrue(\Carbon\Carbon::yesterday()->eq($post->published_on));
    }

    /**
     *@test
     */
    public function an_event_is_fired_if_a_post_is_published_for_the_first_time()
    {
        $post = factory(Post::class)->create(['published' => false, 'published_on' => null]);

        $this->expectsEvents(PostFirstPublished::class);

        $post->publish();
    }
}