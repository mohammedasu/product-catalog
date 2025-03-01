<?php

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

uses(RefreshDatabase::class)->beforeEach(function () {
    Artisan::call('migrate');
});

it('can create a product using a factory', function () {
    $product = Product::factory()->create();

    expect($product)->toBeInstanceOf(Product::class);
    expect($product->name)->not->toBeNull();
    expect($product->category_id)->not->toBeNull();
});

it('can retrieve a product by ID', function () {
    $product = Product::factory()->create();

    $response = $this->getJson("/api/v1/products/{$product->id}");

    $response->assertStatus(200)
        ->assertJsonFragment([
            'id' => $product->id,
            'name' => $product->name,
        ]);
});

it('returns 404 for a non-existing product', function () {
    $response = $this->getJson('/api/v1/products/99999');

    $response->assertStatus(404);
});

it('can update a product', function () {
    $product = Product::factory()->create();
    $updatedData = ['name' => 'Updated Name'];

    $response = $this->putJson("/api/v1/products/{$product->id}", $updatedData);

    $response->assertStatus(201)
        ->assertJsonFragment(['name' => 'Updated Name']);

    expect(Product::find($product->id)->name)->toBe('Updated Name');
});

it('can delete a product', function () {
    $product = Product::factory()->create();

    $response = $this->deleteJson("/api/v1/products/{$product->id}");

    $response->assertStatus(204);
    expect(Product::find($product->id))->toBeNull();
});

