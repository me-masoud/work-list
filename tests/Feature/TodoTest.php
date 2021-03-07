<?php

namespace Tests\Feature;

use App\Models\Todo as ModelsTodo;
use Facade\Ignition\Support\FakeComposer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_check_todo_page_authTest()
    {
    $todo = new ModelsTodo;
    $todo->title =  'kkk';
    $todo->user_id = '2';
    $todo->date     = '2021-02-02';
    $todo->save();
    $todo = true;
    $this->assertCreated($todo);
    }
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
