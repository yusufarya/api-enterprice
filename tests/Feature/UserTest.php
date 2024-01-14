<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testRegisterSuccess()
    {
        $this->post('/api/register', [
            'name' => 'Yusuf Aryadilla',
            'username' => 'yusuf_aryadilla',
            'gender' => 'M',
            'email' => 'yusuf@gmail.com',
            'password' => '111111',
        ])->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => 'Yusuf Aryadilla',
                    'username' => 'yusuf_aryadilla'
                ]
            ]);

    }

    public function testRegisterFailed()
    {
        $this->post('/api/register', [
            'name' => '',
            'username' => '',
            'password' => '',
        ])->assertStatus(400)
            ->assertJson([
                "errors" => [
                    'username' => [
                        "The username field is required."
                    ],
                    'password' => [
                        "The password field is required."
                    ],
                    'name' => [
                        "The name field is required."
                    ]
                ]
            ]);
    }

    public function testRegisterUsernameAlreadyExists()
    {
        $this->testRegisterSuccess();
        $this->post('/api/register', [
            'name' => 'Yusuf Aryadilla',
            'username' => 'yusuf_aryadilla',
            'gender' => 'M',
            'email' => 'yusuf@gmail.com',
            'password' => '111111',
            ])->assertStatus(400)
            ->assertJson([
                "errors" => [
                    'email' => [
                        "email already registered"
                        ]
                        ]
                    ]);
                }
                
    public function testRegisterEmailAlreadyExists()
    {
        $this->testRegisterSuccess();
        $this->post('/api/register', [
            'name' => 'Yusuf Aryadilla',
            'username' => 'yusuf_aryadilla1',
            'gender' => 'M',
            'email' => 'yusuf@gmail.com',
            'password' => '111111',
        ])->assertStatus(400)
            ->assertJson([
                "errors" => [
                    'username' => [
                        "username already registered"
                    ]
                ]
            ]);
    }
}
