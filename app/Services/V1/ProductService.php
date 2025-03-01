<?php
namespace App\Services\V1;

use App\BO\V1\ProductBO;
use App\DAO\V1\ProductDAO;
use App\Interfaces\V1\ProductRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class ProductService
{
    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index($categoryId = null, $search = null)
    {
        $products = $this->productRepository->index($categoryId, $search);
        if (!$products || empty($products['data'])) {
            return [
                'data' => [],
                'total' => 0,
                'per_page' => 10,
                'current_page' => 1,
                'total_pages' => 0
            ];
        }
        return new LengthAwarePaginator(
            collect($products['data'])->map(fn($product) => new ProductBO(new ProductDAO($product))),
            $products['total'] ?? $products['data'] ? count($products['data']) : 0,
            max($products['per_page'] ?? 10, 1),
            $products['current_page'] ?? 1,
        );
    }

    public function show(int $id)
    {
        try {
            $product = $this->productRepository->findById($id);
            return new ProductBO($product);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function store(array $data)
    {
        try {
            $product = $this->productRepository->create($data);
            return new ProductBO($product);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(array $data, int $id)
    {
        try {
            $product = $this->productRepository->update($data, $id);
            return new ProductBO($product);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete(int $id)
    {
        try {
            return $this->productRepository->delete($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
