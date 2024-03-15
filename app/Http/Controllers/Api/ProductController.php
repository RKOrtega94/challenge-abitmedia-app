<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductCollectionResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{

    /**
     * index
     *
     * Get all products
     *
     * For search, use query parameters like this:
     * /api/products?name=product_name&sku=product_sku
     *
     * @return JsonResponse
     */
    function index(): JsonResponse
    {
        try {
            $query = request()->query();
            $products = Product::query();

            foreach ($query as $key => $value) {
                $products->where($key, 'like', "%$value%");
            }

            return $this->sendResponse(
                ProductCollectionResource::collection($products->get()),
                "Products retrieved successfully",
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return $this->sendError("Server Error", [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * show
     *
     * Get a product by id
     *
     * Example: /api/products/1
     *
     * @param  Product $product
     * @return JsonResponse
     */
    function show(Product $product): JsonResponse
    {
        try {
            return $this->sendResponse(new ProductCollectionResource($product), "Product retrieved successfully", Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->sendError("Product not found", [], Response::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            return $this->sendError("Server Error", [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * store
     *
     * Create a new product
     *
     * Example: /api/products
     *
     * {
     * "sku": "new_sku",
     * "name": "new_name",
     * "description": "new_description",
     * "windows_price": new_price,
     * "mac_price": new_price
     * }
     *
     * @param  ProductRequest $request
     * @return JsonResponse
     */
    function store(ProductRequest $request): JsonResponse
    {
        try {
            $product = Product::create($request->validated());
            return $this->sendResponse($product, "Product created successfully", Response::HTTP_CREATED);
        } catch (ValidationException $e) {
            return $this->sendError($e->getMessage(), $e->errors(), Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $th) {
            return $this->sendError("Server Error", [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * update
     *
     * Update a product by id
     *
     * Example: /api/products/1
     *
     * {
     * "sku": "new_sku",
     * "name": "new_name",
     * "description": "new_description",
     * "windows_price": new_price,
     * "mac_price": new_price
     * }
     *
     * @param  ProductRequest $request
     * @param  Product $product
     * @return JsonResponse
     */
    function update(ProductRequest $request, Product $product): JsonResponse
    {
        try {
            $product->update($request->validated());
            return $this->sendResponse($product, "Product updated successfully", Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->sendError("Product not found", [], Response::HTTP_NOT_FOUND);
        } catch (ValidationException $e) {
            return $this->sendError($e->getMessage(), $e->errors(), Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $th) {
            return $this->sendError("Server Error", [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * destroy
     *
     * Delete a product by id
     *
     * Example: /api/products/1
     *
     * @param  Product $product
     * @return JsonResponse
     */
    function destroy(Product $product): JsonResponse
    {
        try {
            $product->delete();
            return $this->sendResponse([], "Product deleted successfully", Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->sendError("Product not found", [], Response::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            return $this->sendError("Server Error", [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
