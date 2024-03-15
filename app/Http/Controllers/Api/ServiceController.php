<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceCollectionResource;
use App\Models\Service;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{
    /**
     * index
     *
     * Get all services
     *
     * For search, use query parameters like this:
     * /api/services?name=service_name&sku=service_sku
     *
     * @return JsonResponse
     */
    function index(): JsonResponse
    {
        try {
            $query = request()->query();
            $services = Service::query();

            foreach ($query as $key => $value) {
                $services->where($key, 'like', "%$value%");
            }

            return $this->sendResponse(
                ServiceCollectionResource::collection($services->get()),
                "Services retrieved successfully",
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return $this->sendError("Server Error", [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * show
     *
     * Get a service by id
     *
     * Example: /api/services/1
     *
     * @param  Service $service
     * @return JsonResponse
     */
    function show(Service $service): JsonResponse
    {
        try {
            return $this->sendResponse($service, "Service retrieved successfully", Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->sendError("Service not found", [], Response::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            return $this->sendError("Server Error", [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * store
     *
     * Store a new service
     *
     * Example: /api/services
     *
     * {
     * "sku": "new_sku",
     * "name": "new_name",
     * "description": "new_description",
     * "price": new_price,
     * }
     *
     * @param  ServiceRequest $request
     * @return JsonResponse
     */
    function store(ServiceRequest $request): JsonResponse
    {
        try {
            $service = Service::create($request->validated());
            return $this->sendResponse($service, "Service created successfully", Response::HTTP_CREATED);
        } catch (ValidationException $e) {
            return $this->sendError($e->getMessage(), $e->errors(), Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $th) {
            return $this->sendError("Server Error", [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * update
     *
     * Update a service by id
     *
     * Example: /api/services/1
     *
     * {
     * "sku": "new_sku",
     * "name": "new_name",
     * "description": "new_description",
     * "price": new_price,
     * }
     *
     * @param  mixed $request
     * @param  mixed $service
     * @return JsonResponse
     */
    function update(ServiceRequest $request, Service $service): JsonResponse
    {
        try {
            $service->update($request->validated());
            return $this->sendResponse($service, "Service updated successfully", Response::HTTP_OK);
        } catch (ValidationException $e) {
            return $this->sendError($e->getMessage(), $e->errors(), Response::HTTP_BAD_REQUEST);
        } catch (ModelNotFoundException $e) {
            return $this->sendError("Service not found", [], Response::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            return $this->sendError("Server Error", [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * destroy
     *
     * Delete a service by id
     *
     * Example: /api/services/1
     *
     * @param  Service $service
     * @return JsonResponse
     */
    function destroy(Service $service): JsonResponse
    {
        try {
            $service->delete();
            return $this->sendResponse([], "Service deleted successfully", Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->sendError("Service not found", [], Response::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            return $this->sendError("Server Error", [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
