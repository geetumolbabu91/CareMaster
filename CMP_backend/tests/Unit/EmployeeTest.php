<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Models\Company;
use App\Models\Employee;

class EmployeeTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_employee_store_validation_checking(): void
    {
        $response = $this->postJson('/api/employee', 
        [
            'first_name'              => 'Test Name',
            'email_address'           => 'testinsert',
        ]);
            $response->assertJson(fn (AssertableJson $json) =>
                 $json->hasAll(['success', 'data','message'])
            );
            $this->assertFalse($response['success']);
        
    }

    public function test_employee_store_checking(): void
    {
        $response = $this->postJson('/api/employee', 
        [
            'first_name'              => fake()->firstName(),
            'last_name'               => fake()->lastName(),
            'email'                   => fake()->unique()->safeEmail(),
            'phone_number'            => fake()->e164PhoneNumber(),
            'company_id'              => Company::all()->random()->id
        ]);
 
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => true,
            ])->assertValid();
        
    }

    public function test_employee_update_validation_checking(): void
    {
        $id = Employee::all()->last()->id;
        $response = $this->putJson('/api/employee/'.$id, 
        [
            'last_name'               => NULL,
            'company_id'              => 'testinsert',
        ]);
            $response->assertJson(fn (AssertableJson $json) =>
                 $json->hasAll(['success', 'data','message'])
            );
            $this->assertFalse($response['success']);
        
    }

    public function test_employee_update_checking(): void
    {
        $id = Employee::all()->last()->id;
        $response = $this->putJson('/api/employee/'.$id, 
        [
            'first_name'              => fake()->firstName(),
            'last_name'               => fake()->lastName(),
            'phone_number'            => fake()->e164PhoneNumber(),
        ]);
 
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => true,
            ])->assertValid();
        
    }


    public function test_employee_delete(): void {
        $id = Employee::all()->last()->id;
       
        $response = $this->deleteJson('/api/employee/'.$id);
     
            $response
                ->assertStatus(200)
                ->assertJson([
                    'status' => true,
                ]);
    
        }
}
