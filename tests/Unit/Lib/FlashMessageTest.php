<?php

namespace Tests\Unit\Lib;

use Lib\FlashMessage;
use PHPUnit\Framework\TestCase;

class FlashMessageTest extends TestCase
{
    protected function setUp(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['flash'] = [];
    }

    protected function tearDown(): void
    {
        $_SESSION['flash'] = [];
    }

    public function test_success(): void
    {
        FlashMessage::success('Success message');
        $flash = FlashMessage::getMessages();

        $this->assertCount(1, $flash);
        $this->assertEquals('success', $flash[0]['type']);
        $this->assertEquals('Success message', $flash[0]['text']);
    }

    public function test_danger(): void
    {
        FlashMessage::danger('Danger message');
        $flash = FlashMessage::getMessages();

        $this->assertCount(1, $flash);
        $this->assertEquals('danger', $flash[0]['type']);
        $this->assertEquals('Danger message', $flash[0]['text']);
    }

    public function test_get_messages_clears_session(): void
    {
        FlashMessage::success('Success message');
        FlashMessage::danger('Danger message');

        $flash = FlashMessage::getMessages();

        $this->assertCount(2, $flash);
        $this->assertEquals('success', $flash[0]['type']);
        $this->assertEquals('Success message', $flash[0]['text']);
        $this->assertEquals('danger', $flash[1]['type']);
        $this->assertEquals('Danger message', $flash[1]['text']);

        $this->assertEmpty($_SESSION['flash']);
    }
}
