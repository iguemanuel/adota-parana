<?php

namespace Tests\Unit\Models\Users;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    private User $user;
    private User $user2;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = new User([
            'name' => 'User 1',
            'email' => 'fulano@example.com',
            'encrypted_password' => password_hash('123456', PASSWORD_DEFAULT),
            'phone' => '42991234567',
            'role' => 'user'
        ]);
        $this->user->save();

        $this->user2 = new User([
            'name' => 'User 2',
            'email' => 'fulano1@example.com',
            'encrypted_password' => password_hash('123456', PASSWORD_DEFAULT),
            'phone' => '42991234568',
            'role' => 'admin'
        ]);
        $this->user2->save();
    }

    public function test_should_create_new_user(): void
    {
        $this->assertCount(2, User::all());
    }

    public function test_all_should_return_all_users(): void
    {
        $expectedIds = [$this->user->id, $this->user2->id];
        $actualIds = array_map(fn($user) => $user->id, User::all());

        $this->assertCount(2, $actualIds);
        $this->assertEquals($expectedIds, $actualIds);
    }

    public function test_destroy_should_remove_the_user(): void
    {
        $this->user->destroy();
        $this->assertCount(1, User::all());
    }

    public function test_setters_and_getters(): void
    {
        $this->user->id = 10;
        $this->assertEquals(10, $this->user->id);

        $this->user->name = 'User name';
        $this->assertEquals('User name', $this->user->name);

        $this->user->email = 'outro@example.com';
        $this->assertEquals('outro@example.com', $this->user->email);
    }

    public function test_errors_should_return_errors_for_empty_fields(): void
    {
        $user = new User();

        $this->assertFalse($user->isValid());
        $this->assertFalse($user->save());
        $this->assertTrue($user->hasErrors());

        $this->assertEquals('não pode ser vazio!', $user->errors('name'));
        $this->assertEquals('não pode ser vazio!', $user->errors('email'));
    }

    public function test_find_by_id_should_return_the_user(): void
    {
        $foundUser = User::findById($this->user->id);
        $this->assertEquals($this->user->id, $foundUser->id);
    }

    public function test_find_by_id_should_return_null(): void
    {
        $this->assertNull(User::findById(9999));
    }

    public function test_find_by_email_should_return_the_user(): void
    {
        $foundUser = User::findByEmail($this->user->email);
        $this->assertEquals($this->user->id, $foundUser->id);
    }

    public function test_find_by_email_should_return_null(): void
    {
        $this->assertNull(User::findByEmail('not.exits@example.com'));
    }

    public function test_authenticate_should_return_true_for_correct_password(): void
    {
        $this->assertTrue($this->user->authenticate('123456'));
    }

    public function test_authenticate_should_return_false_for_incorrect_password(): void
    {
        $this->assertFalse($this->user->authenticate('wrong'));
        $this->assertFalse($this->user->authenticate(''));
    }

    public function test_update_should_not_change_the_password(): void
    {
        $this->user->password = '654321';
        $this->user->save();

        $this->assertTrue($this->user->authenticate('123456'));
        $this->assertFalse($this->user->authenticate('654321'));
    }

    public function test_update_should_change_user_attributes(): void
    {
        $this->user->name = 'New Name';
        $this->user->email = 'new.email@example.com';
        $this->assertTrue($this->user->save());

        $updatedUser = User::findById($this->user->id);

        $this->assertEquals('New Name', $updatedUser->name);
        $this->assertEquals('new.email@example.com', $updatedUser->email);
    }

    public function test_is_admin_should_return_correct_boolean(): void
    {
        $this->assertFalse($this->user->isAdmin());
        $this->assertTrue($this->user2->isAdmin());
    }

    public function test_should_fail_validation_for_non_unique_email(): void
    {
        $newUser = new User([
            'name' => 'Another User',
            'email' => 'fulano@example.com',
            'phone' => '42998765432',
            'role' => 'user'
        ]);

        $this->assertFalse($newUser->isValid());
        $this->assertEquals('já existe um registro com esse dado', $newUser->errors('email'));
    }
}