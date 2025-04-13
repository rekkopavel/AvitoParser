<?php

namespace Tests\Feature;

use App\Models\Product;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParserCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_runs_parser_command_successfully()
    {


        $this->artisan('db:seed --class=QuerySeeder')
            ->assertExitCode(0);

                $this->artisan('parser:run')
                    ->assertExitCode(0);


        $this->assertTrue(DB::table('products')->count() > 0);


                $product = Product::first();


                $this->assertNotEmpty($product->uri);
                $this->assertNotEmpty($product->title);
                $this->assertNotEmpty($product->city);





    }
}
