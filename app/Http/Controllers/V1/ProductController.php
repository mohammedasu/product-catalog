<?php

namespace App\Http\Controllers\V1;

use App\Classes\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ProductStoreRequest;
use App\Http\Requests\V1\ProductUpdateRequest;
use App\Services\V1\ProductService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    private ProductService $productService;
    
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request): JsonResponse
    {    
        $data = $this->productService->index($request->category_id, $request->search);

        return ApiResponse::send($data,'List of Products',200);
    }

    public function store(ProductStoreRequest $request): JsonResponse
    {
        try {
            $product = $this->productService->store($request->validated());
            return ApiResponse::send($product,'Product Create Successful',201);
        } catch (Exception $e) {
            return ApiResponse::fail($e->getMessage(),'Product creation failed',500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $product = $this->productService->show($id);

            return ApiResponse::send($product,'',200);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::fail($e->getMessage(),'',404);
        } catch (Exception $e) {
            return ApiResponse::fail($e->getMessage(),'Internal Server Error',500);
        }
    }

    public function update(ProductUpdateRequest $request, int $id): JsonResponse
    {
        try {
            $product = $this->productService->update($request->validated(), $id);
            return ApiResponse::send($product,'Product Update Successful',201);
        } catch (Exception $e) {
            return ApiResponse::fail($e->getMessage(),'Product updation failed',500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            return $this->productService->delete($id)
                ? ApiResponse::send('', 'Product Delete Successful',204)
                : ApiResponse::fail('', 'Product not found',404);
        } catch (Exception $e) {
            ApiResponse::fail($e->getMessage(), 'Product deletion failed',500);
        }
    }
}
