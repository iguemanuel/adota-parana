<?php 

namespace Database\Populate;

use App\Models\User;

class UserPopulate{
    public static function populate():void{
        $admin = [
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'encrypted_password' => '123',
            'phone' => '1234567890',
            'role' => 'admin',
        ];
        $adminUser = new User($admin);
        $adminUser->save();

        $user = [
            'name' => 'User',
            'email' => 'fulano',
            'encrypted_password' => 'abc123',
            'phone' => '0987654321',
            'role' => 'user',
        ];
        $regularUser = new User($user);
        $regularUser->save();
    }
}
