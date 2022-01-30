<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


class SchoolTest extends TestCase
{
    /**
     * Authenticate user.
     *
     * @return void
     */
    protected function authenticate()
    {
        $user = User::create([
            'name' => 'test',
            'email' => rand(12345,678910).'test@test.com',
            'password' => \Hash::make('password11223344@1122'),
        ]);

        if (!auth()->attempt(['email'=>$user->email, 'password'=>'password11223344@1122'])) {
            return response(['message' => 'Login credentials are invaild']);
        }
         return $accessToken = auth()->user()->createToken('authToken')->accessToken;
    }

    /**
     * test create schools.
     *
     * @return void
     */
    public function test_create_school()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST',route('schools.store'),[
            'name' => 'Test school',
            'sku' => rand(0,1),
        ]);


        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }

    /**
     * test update schools.
     *
     * @return void
     */
    public function test_update_school()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('PUT',route('schools.update',9),[
            'name' => 'Test school9',
            'status' => 1
        ]);

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }

    /**
     * test find schools.
     *
     * @return void
     */
    public function test_find_school()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET',route('schools.show',1));

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }

    /**
     * test get all schools.
     *
     * @return void
     */
    public function test_get_all_school()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET',route('schools.index'));

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }

    /**
     * test delete schools.
     *
     * @return void
     */
    public function test_delete_school()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('DELETE',route('schools.destroy',10));

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }
}
