<?php

namespace Tests\Acceptance\Access;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class AdotaParanaAccessTest extends TestCase
{
    private Client $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = new Client([
            'allow_redirects' => false,
            'base_uri' => 'http://web:8080'
        ]);
    }

    public function test_should_access_public_home_route_without_authentication(): void
    {
        $response = $this->client->get('/');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_should_access_login_route_without_authentication(): void
    {
        $response = $this->client->get('/login');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_should_access_register_route_without_authentication(): void
    {
        $response = $this->client->get('/register');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_should_not_access_admin_dashboard_if_not_authenticated(): void
    {
        $response = $this->client->get('/admin/dashboard');

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('/', $response->getHeaderLine('Location'));
    }

    public function test_should_accept_post_request_to_login_route(): void
    {
        $response = $this->client->post('/login', [
            'form_params' => [
                'email' => 'test@example.com',
                'password' => 'wrongpassword'
            ]
        ]);

        $this->assertContains($response->getStatusCode(), [200, 302]);
    }

    public function test_should_accept_post_request_to_register_route(): void
    {
        $response = $this->client->post('/register', [
            'form_params' => [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'phone' => '4899999999',
                'password' => 'testpassword',
                'password_confirmation' => 'testpassword'
            ]
        ]);

        $this->assertContains($response->getStatusCode(), [200, 302]);
    }

    public function test_should_accept_post_request_to_logout_route(): void
    {
        $response = $this->client->post('/logout');

        $this->assertEquals(302, $response->getStatusCode());
    }
}
