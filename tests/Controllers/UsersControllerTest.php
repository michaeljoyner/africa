<?php


use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function the_users_name_and_email_are_correctly_updated()
    {
        $this->asLoggedInUser();
        $user = factory(User::class)->create();

        $this->post('/admin/users/' . $user->id, ['name' => 'Testy McTestyFace', 'email' => 'testy@example.com'])
            ->assertResponseStatus(302)
            ->seeInDatabase('users', [
                'id' => $user->id,
                'name' => 'Testy McTestyFace',
                'email' => 'testy@example.com'
            ]);
    }

    /**
     *@test
     */
    public function a_user_is_properly_deleted()
    {
        $this->asLoggedInUser();
        $user = factory(User::class)->create();

        $this->delete('/admin/users/' . $user->id)
            ->assertResponseStatus(302)
            ->notSeeInDatabase('users', ['id' => $user->id]);
    }
}