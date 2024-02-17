<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Store;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StoreManagementTest extends TestCase
{
    use DatabaseTransactions;
    const apiURL = '/api/stores';
    const dataStructure = [
        'id',
        'name',
        'slug',
        'address',
        'phone',
        'email',
        'created_at',
        'updated_at',
    ];

    protected $dataBody;

    protected $newData;

    public function setUp(): void
    {
        parent::setUp();

        $user = User::find(1);
        $this->actingAs($user);
        
        $this->dataBody = [
            'name' => 'UniqueStoreName',
            'slug' => 'unique-store-name',
            'address' => 'UniqueStoreAddress',
            'phone' => 'UniqueStorePhone',
            'email' => 'UniqueStoreEmail',
        ];

        $this->newData = Store::factory()->create();
    }

    /**
     * get all stores
     */
    public function test_get_all_stores()
    {
        $response = $this->get(self::apiURL);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                '*' => self::dataStructure,
            ],
        ]);
    }

    /**
     * create a store
     */
    public function test_create_store()
    {
        $response = $this->post(self::apiURL, $this->dataBody);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => self::dataStructure,
        ]);
    }

    /**
     * get a store
     */
    public function test_get_store()
    {
        \Log::info(self::apiURL . $this->newData->id);
        $response = $this->get(self::apiURL .'/'. $this->newData->id);
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => self::dataStructure,
        ]);
    }

    /**
     * update a store
     */
    public function test_update_store()
    {
        $response = $this->put(self::apiURL . '/'. $this->newData->id , $this->dataBody);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => self::dataStructure,
        ]);
    }

    /**
     * delete a store
     */
    public function test_delete_store()
    {
        $response = $this->delete(self::apiURL . '/' . $this->newData->id);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }
}
