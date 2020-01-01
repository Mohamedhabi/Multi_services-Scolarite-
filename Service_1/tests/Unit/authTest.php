<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Student;

class authTest extends TestCase
{
    /**
     * Unit test for testing login with valid data.
     *
     * @return void
     */
    public function testLogin()
    {
        $response = $this->json('POST', '/api/auth/login', ['email' => 'mohamed@test.com','password'=> '123']);

        $response  
            ->assertStatus(200)->assertSee("name")->assertSee("access_token");
    }
    /**
     * Unit test for testing login with wrong data.
     *
     * @return void
     */
    public function testWrongLogin()
    {
        $response = $this->json('POST', '/api/auth/login', ['email' => 'mohamed@test.com','password'=> '1234']);

        $response
            ->assertStatus(401)->assertSee("Wrong email or password");
    }
    /**
     * Unit test for testing add new student.
     *
     * @return void
     */
    public function testAddStudent()
    {
        $response1 = $this->json('POST', '/api/auth/login', ['email' => 'mohamed@test.com','password'=> '123']);    
        $response2 = $this->json('POST', '/api/auth/student', ['token'=>$response1->getData()->access_token,'first_name'=> 'Moh','last_name'=>'Habi','adress'=>'Paris','level'=>'1CS','birth_place'=>'Setif','birth_day'=>'1999-11-11']);
        $response2
            ->assertStatus(200)->assertSee("success");
    }

    /**
     * Unit test for testing add new student with missing data.
     *
     * @return void
     */
    public function testAddStudentNoData()
    {
        $response1 = $this->json('POST', '/api/auth/login', ['email' => 'mohamed@test.com','password'=> '123']);    
        $response2 = $this->json('POST', '/api/auth/student', ['token'=>$response1->getData()->access_token]);
        $student=Student::latest()->first();
        $response2
            ->assertStatus(500)->assertSee("first_name")->assertSee("error");
    }
    /**
     * Unit test for testing delete the last student in DB.
     *
     * @return void
     */
    public function testDeleteLastStudent()
    {
        $response1 = $this->json('POST', '/api/auth/login', ['email' => 'mohamed@test.com','password'=> '123']);   
        $student=Student::latest()->first(); 
        $response2 = $this->json('DELETE', '/api/auth/student/'.$student->id, ['token'=>$response1->getData()->access_token]);
        $response2
            ->assertStatus(200)->assertSee("student deleted")->assertSee("success");
    }
     /**
     * Unit test for testing delete non existing student.
     *
     * @return void
     */
    public function testDeleteLastStudentNotFound()
    {
        $response1 = $this->json('POST', '/api/auth/login', ['email' => 'mohamed@test.com','password'=> '123']);   
        $student=Student::latest()->first(); 
        $response2 = $this->json('DELETE', '/api/auth/student/'.(($student->id)+1), ['token'=>$response1->getData()->access_token]);
        $response2
            ->assertStatus(404)->assertSee("student not found")->assertSee("message");
    }
}
