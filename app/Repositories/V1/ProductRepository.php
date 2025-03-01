<?php

namespace App\Repositories\V1;

use App\DAO\V1\ProductDAO;
use App\Models\Product;
use App\Interfaces\V1\ProductRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;

class ProductRepository implements ProductRepositoryInterface
{
   public function index($categoryId = null, $search = null){
      return Cache::remember("products_{$categoryId}_{$search}", 3600, function () use ($categoryId, $search) {
         $products = Product::when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->when($search, fn($q) => $q->where('name', 'LIKE', "%$search%")->orWhere('description', 'LIKE', "%$search%"))
            ->paginate(10);

            return [
               'data' => $products->map(fn($product) => (new ProductDAO($product->toArray()))->toArray())->all(),
               'total' => $products->total(),
               'per_page' => max($products->perPage(), 1),
               'current_page' => $products->currentPage(),
            ];
      }); 
   }

   public function findById(int $id){
      try {
         $product = Product::findOrFail($id);
         return new ProductDAO($product->toArray());
      } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("Product with ID {$id} not found.");
      } catch (Exception $e) {
            throw new Exception($e->getMessage());
      }
   }

   public function create(array $data){
      try {
         $product = Product::create($data);
         return new ProductDAO($product->toArray());
      } catch (Exception $e) {
            throw new Exception($e->getMessage());
      }
   }

   public function update(array $data, int $id){
      try {
         $product = Product::findOrFail($id);
         tap($product)->update($data);
         return new ProductDAO($product->toArray());
      } catch (ModelNotFoundException $e) {
            throw $e;
      } catch (Exception $e) {
            throw new Exception($e->getMessage());
      }
     
   }
   
   public function delete(int $id){
      try {
         $product = Product::findOrFail($id);
         return $product->delete();
     } catch (ModelNotFoundException $e) {
         throw $e;
     } catch (Exception $e) {
         throw new Exception($e->getMessage());
     }
   }
}
