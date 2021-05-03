<?php
declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Transaction;
use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase
{

    public function testNewTransaction(): void
    {
        $transaction = new Transaction();
        self::assertInstanceOf(Transaction::class, $transaction);
    }

    public function testWhereDescription(): void
    {
        $transaction = new Transaction(['description' => 'Test']);
        self::assertEquals('Test', $transaction->description);
    }

    public function testWhereWalletId(): void
    {
        $transaction = new Transaction(['wallet_id' => 'Test']);
        self::assertEquals('Test', $transaction->wallet_id);
    }

    public function testWhereIsFraudulent(): void
    {
        $transaction = new Transaction();
        self::assertEquals(false, $transaction->is_fraudulent);
    }

    public function testWhereAmount(): void
    {
        $transaction = new Transaction(['amount' => -100]);
        self::assertEquals(-100, $transaction->amount);
    }
}
