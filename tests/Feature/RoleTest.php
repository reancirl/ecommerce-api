<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;


class RoleTest extends TestCase
{
    use DatabaseTransactions;

    const apiURL = '/api/roles/';

    const dataStructure = [
        'id',
        'name',
        'guard_name',
        'created_at',
        'updated_at',
    ];

    protected $dataBody;

    protected $newData;

    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs($user);
        
        $this->dataBody = [
            'name' => 'UniqueRoleName',
        ];

        $this->newData = Role::factory()->create();
    }

    /**
     * Get all roles
     */
    public function test_get_all_roles()
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
     * Create a role using spatie permission package
     */
    public function test_create_role()
    {
        $response = $this->postJson(self::apiURL, $this->dataBody);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => self::dataStructure,
        ]);
    }

    /**
     * Get a single role
     */
    public function test_get_single_role()
    {
        $response = $this->get(self::apiURL . $this->newData->id);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => self::dataStructure,
        ]);
    }
  
    /**
     * Edit a role
     */
    public function test_edit_role()
    {
        $response = $this->putJson(self::apiURL . $this->newData['id'], $this->dataBody);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => self::dataStructure,
        ]); 
    }

    /** 
     * Delete Role
     */

    public function test_delete_role()
    {
        $response = $this->delete(self::apiURL . $this->newData->id);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }

    /**
     * Get all permissions
     */
    public function test_get_all_permissions()
    {
        $response = $this->get('/api/permissions');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'message',
            'permissions' => [],
        ]);
    }
}
