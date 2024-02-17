<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Category;
use App\Models\User;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use DatabaseTransactions;
    const apiURL = '/api/categories';

    protected $dataBody;

    protected $newData;
    const dataStructure = [
        'id',
        'name',
        'slug',
        'description',
        'created_at',
        'updated_at',
    ];

    public function setUp(): void
    {
        parent::setUp();

        $user = User::find(1);

        $this->actingAs($user);

        $this->dataBody = [
            'name' => 'UniqueCategoryName',
            'slug' => 'unique-category-name',
            'description' => 'UniqueCategoryDescription',
        ];

        $this->newData = Category::factory()->create();
    }

    /**
     * list all categories
     */
    public function test_list_all_categories()
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
     * create a category
     */
    public function test_create_a_category()
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
     * show a category
     */
    public function test_show_a_category()
    {
        $response = $this->get(self::apiURL .'/'. $this->newData->id);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => self::dataStructure,
        ]);
    }

    /**
     * update a category
     */
    public function test_update_a_category()
    {
        $response = $this->put(self::apiURL .'/'. $this->newData->id, $this->dataBody);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => self::dataStructure,
        ]);
    }

    /**
     * delete a category
     */
    public function test_delete_a_category()
    {
        $response = $this->delete(self::apiURL .'/'. $this->newData->id);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'message',
        ]);
    }
}
