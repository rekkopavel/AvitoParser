<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ParserCommandTest extends TestCase
{

    public function test_it_runs_parser_command_successfully()
    {

        Notification::fake();

        Product::truncate();

        $this->artisan('db:seed')
            ->assertExitCode(0);

        $this->artisan('parser:run')
            ->assertExitCode(0);


        $this->assertDatabaseCount('links', 1);


        $link = Product::first();


        $this->assertNotEmpty($link->url);
        $this->assertNotEmpty($link->title);

        $subscriber = Subscriber::first();

        Notification::assertSentTo(
            $subscriber,
            \App\Notifications\ProductsFound::class,

        );
    }
}
