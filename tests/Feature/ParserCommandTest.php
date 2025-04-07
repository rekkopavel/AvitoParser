<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParserCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_runs_parser_command_successfully()
    {

        Notification::fake();

        Product::truncate();

        $this->artisan('db:seed')
            ->assertExitCode(0);

        $this->artisan('parser:run')
            ->assertExitCode(0);


        $this->assertDatabaseCount('products', 1);


        $product = Product::first();


        $this->assertNotEmpty($product->url);
        $this->assertNotEmpty($product->title);

        $subscriber = Subscriber::first();

        Notification::assertSentTo(
            $subscriber,
            \App\Notifications\ProductsFound::class,

        );
    }
}
