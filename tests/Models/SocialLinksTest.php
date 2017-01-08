<?php


use App\Assocciates\Partner;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SocialLinksTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_social_link_can_be_created_and_persisted_for_a_sociable_entity()
    {
        //Partner has a relationship with SocialLink
        $partner = factory(Partner::class)->create();

        $link = factory(App\Social\SocialLink::class)->create([
            'sociable_id' => $partner->id,
            'sociable_type' => Partner::class,
        ]);

        $this->assertInstanceOf(App\Social\SocialLink::class, $link);
    }
}