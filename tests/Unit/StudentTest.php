<?php

namespace Tests\Unit;

use App\Models\School;
use Database\Factories\StudentFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


class StudentTest extends TestCase
{
    /**
     * Authenticate admin.
     *
     * @return void
     */
    protected function authenticate()
    {
        $admin = User::create([
            'name' => 'test',
            'email' => rand(12345, 678910) . 'test@test.com',
            'password' => \Hash::make('password11223344@1122'),
        ]);

        if (!auth()->attempt(['email' => $admin->email, 'password' => 'password11223344@1122'])) {
            return response(['message' => 'Login credentials are invaild']);
        }
        return $accessToken = auth()->user()->createToken('authToken')->accessToken;
    }



    /**
     * test create students.
     *
     * @return void
     */
    public function test_create_student()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', route('students.store'), [
            'name' => 'Test school',
            'status' => rand(0, 1),
            'order' => rand(0, 10000),
            'student_id' => random_int(1, School::count())
        ]);


        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }

    /**
     * test update students.
     *
     * @return void
     */
    public function test_update_student()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('PUT', route('students.update', 1), [
            'name' => 'Test school',
            'status' => rand(0, 1),
            'order' => rand(0, 10000),
            'student_id' => random_int(1, School::count())
        ]);

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }

    /**
     * test find students.
     *
     * @return void
     */
    public function test_find_student()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', route('students.show', 1));

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }

    /**
     * test get all students.
     *
     * @return void
     */
    public function test_get_all_student()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', route('students.index'));

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }

    /**
     * test delete students.
     *
     * @return void
     */
    public function test_delete_student()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('DELETE', route('students.destroy', 2));

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }
}
