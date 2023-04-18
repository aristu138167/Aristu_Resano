<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class GetEarlyAdopterControllerTest extends TestCase
{
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->userDataSource = Mockery::mock(UserDataSource::class);
        $this->app->bind(UserDataSource::class, function () {
            return $this->userDataSource;
        });
    }

    /**
     * @test
     */
    public function userWithGivenEmailDoesNotExist()
    {
        $this->userDataSource
            ->expects('findByEmail')
            ->with('email@email.com')
            ->andReturnNull();

        $response = $this->get('/api/users/early-adopter/email@email.com');

        $response->assertNotFound();
        $response->assertExactJson(['error' => 'usuario no encontrado']);
    }

    /**
     * @test
     */
    public function getsEarlyAdopterTrue()
    {
        $this->userDataSource
            ->expects('findByEmail')
            ->with('email@email.com')
            ->andReturn(new User(1,'email@email.com'));

        $response = $this->get('/api/users/early-adopter/email@email.com');

        $response->assertOk();
        $response->assertExactJson(['El usuario es early adopter']);
    }
    /**
     * @test
     */
    public function getsEarlyAdopterFalse()
    {
        $this->userDataSource
            ->expects('findByEmail')
            ->with('email2@email.com')
            ->andReturn(new User(1000,'email2@email.com'));

        $response = $this->get('/api/users/early-adopter/email2@email.com');
        $response->assertOk();
        $response->assertExactJson(['El usuario no es early adopter']);
    }

}
