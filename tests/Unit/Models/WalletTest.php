<?php
declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Wallet;
use PHPUnit\Framework\TestCase;

class WalletTest extends TestCase
{

    public function testNewWallet(): void
    {
        $wallet = new Wallet();
        self::assertInstanceOf(Wallet::class, $wallet);
    }

    public function testWhereUserId(): void
    {
        $wallet = new Wallet(['user_id' => 'Test']);
        self::assertEquals('Test', $wallet->user_id);
    }

    public function testWhereName(): void
    {
        $wallet = new Wallet(['name' => 'Test']);
        self::assertEquals('Test', $wallet->name);
    }
}
