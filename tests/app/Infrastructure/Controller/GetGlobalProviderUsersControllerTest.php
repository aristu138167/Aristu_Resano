<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class GetGlobalProviderUsersControllerTest extends TestCase
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
    public function getsAllGlobalProviderUsersEmpty()
    {
        $this->userDataSource
            ->expects('getAll')
            ->andReturn([]);

        $response = $this->get('/api/global-provider-users');

        $response->assertOk();
        $response->assertExactJson([]);
    }
    /**
     * @test
     */
    public function getsAllGlobalProviderUsersFull()
    {
        $this->userDataSource
            ->expects('getAll')
            ->andReturn([new User(1,'email@gmail.com'),new User(2,'another_email@hotmail.com')]);

        $response = $this->get('/api/global-provider-users');

        $response->assertOk();
       $response->assertExactJson([['id' => 1, 'email' => 'email@gmail.com'],['id' => 2, 'email' => 'another_email@hotmail.com']]);
    }

}
