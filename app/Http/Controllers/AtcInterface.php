<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface AtcInterface
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     * @author alvaro.assmus@bairesdev.com
     */
    public function boot(Request $request): JsonResponse;

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     * @author alvaro.assmus@bairesdev.com
     */
    public function enqueue(Request $request): JsonResponse;

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     * @author alvaro.assmus@bairesdev.com
     */
    public function dequeue(Request $request): JsonResponse;

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     * @author alvaro.assmus@bairesdev.com
     */
    public function list(): JsonResponse;
}
