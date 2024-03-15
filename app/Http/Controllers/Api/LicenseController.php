<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LicenseRequest;
use App\Http\Resources\LicenseResource;
use App\Models\License;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class LicenseController extends Controller
{
    /**
     * index
     *
     * Get all licenses
     *
     * For search, use query parameters like this:
     * /api/licenses?platform=windows
     *
     * @return JsonResponse
     */
    function index(): JsonResponse
    {
        try {
            $queries = request()->query();

            foreach ($queries as $key => $value) {
                $queries[$key] = $value;
            }

            $licenses = License::when($queries['platform'] ?? null, function ($query, $platform) {
                return $query->where('platform', $platform);
            })->when($queries['status'] ?? null, function ($query, $status) {
                return $query->where('status', $status);
            })->when($queries['product'] ?? null, function ($query, $product) {
                $products = Product::whereRaw("LOWER(name) like '%" . strtolower($product) . "%'");
                return $query->whereIn('product_id', $products->pluck('id'));
            })->get();

            return $this->sendResponse(
                LicenseResource::collection($licenses),
                "Licenses retrieved successfully",
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->sendError("Server Error", [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * show
     *
     * Get a license by id
     *
     * Example: /api/licenses/1
     *
     * @param  mixed $license
     * @return JsonResponse
     */
    function show(License $license): JsonResponse
    {
        try {
            return $this->sendResponse(
                new LicenseResource($license),
                "License retrieved successfully",
                Response::HTTP_OK
            );
        } catch (ModelNotFoundException $e) {
            return $this->sendError("Product not found", [], Response::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            return $this->sendError("Server Error", [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * store
     *
     * Create a new license
     *
     * Example: /api/licenses
     *
     * {
     * "product_id": 1,
     * "platform": "windows",
     * }
     *
     * @param  LicenseRequest $license
     * @return JsonResponse
     */
    function store(LicenseRequest $license): JsonResponse
    {
        try {
            // TODO: Add stock validation here

            $license = License::create($license->validated());
            return $this->sendResponse(
                new LicenseResource($license),
                "License created successfully",
                Response::HTTP_CREATED
            );
        } catch (ModelNotFoundException $e) {
            return $this->sendError("Product not found", [], Response::HTTP_NOT_FOUND);
        } catch (ValidationException $e) {
            return $this->sendError($e->getMessage(), $e->errors(), Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $th) {
            Log::info($th);
            return $this->sendError("Server Error", [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * update
     *
     * Update a license
     *
     * Example: /api/licenses/1
     *
     * {
     * "status": "sold",
     * }
     *
     * @param  LicenseRequest $request
     * @param  License $license
     * @return JsonResponse
     */
    function update(LicenseRequest $request, License $license): JsonResponse
    {
        try {
            $license->update($request->validated());
            return $this->sendResponse(
                new LicenseResource($license),
                "License updated successfully",
                Response::HTTP_OK
            );
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
     * Delete a license by id
     *
     * Example: /api/licenses/1
     *
     * @param  License $license
     * @return JsonResponse
     */
    function destroy(License $license): JsonResponse
    {
        try {
            $license->delete();
            return $this->sendResponse(
                [],
                "License deleted successfully",
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return $this->sendError("Server Error", [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
