<?php

namespace Tests\Unit;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Company;
use Illuminate\Testing\Fluent\AssertableJson;


class CompanyTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    public function test_company_store_validation_checking(): void
     {
         $response = $this->postJson('/api/company', 
         [
             'name'                    => 'Test Name',
             'email_address'           => 'testinsert',
         ]);
             $response->assertJson(fn (AssertableJson $json) =>
                  $json->hasAll(['success', 'data','message'])
             );
             $this->assertFalse($response['success']);
         
     }

    public function test_company_store(): void
    {
        $response = $this->postJson('/api/company', 
        [
            'name'              => fake()->name(),
            'email_address'     => fake()->unique()->safeEmail(),
            'logo'              => UploadedFile::fake()->image('avatar.jpg', 100, 100)->size(100),
            'website_address'   => fake()->url()
        ]);
 
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => true,
            ])->assertValid();
            

        Storage::disk('public')->assertExists('images/'.$response['fileName']);

    }
    public function test_company_update_validation_checking(): void
    {
        $id = Company::all()->last()->id;
        $response = $this->putJson('/api/company/'.$id, 
        [
            'name'                    => NULL,
            'company_id'              => 'testinsert',
        ]);
            $response->assertJson(fn (AssertableJson $json) =>
                 $json->hasAll(['success', 'data','message'])
            );
            $this->assertFalse($response['success']);
        
    }

    public function test_company_update(): void
    {
        $id = Company::all()->last()->id;

        $response = $this->putJson('/api/company/'.$id, 
        [
            'name'              => fake()->name(),
            'email_address'     => fake()->unique()->safeEmail(),
            'logo'              => UploadedFile::fake()->image('avatar.jpg', 100, 100)->size(100),
            'website_address'   => fake()->url()
        ]);
 
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => true,
            ])->assertValid();
            

        Storage::disk('public')->assertExists('images/'.$response['fileName']);

    }

    public function test_company_delete(): void {
        $id = Company::all()->last()->id;

        $response = $this->deleteJson('/api/company/'.$id);
     
            $response
                ->assertStatus(200)
                ->assertJson([
                    'status' => true,
                ]);
    
        }
}
