<?php

namespace App\Http\Controllers;

use Exception;
use App\Exceptions\Handler;
use App\Models\Atc\Aircraft;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/*LOGIC layer*/

class AtcController extends Controller implements AtcInterface
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     * @author alvaro.assmus@bairesdev.com
     */
    public function boot(Request $request): JsonResponse
    {
        try {
            // HERE GOES THE CODE
            // throw new Exception('TODO GUD', 503);
            $air = new Aircraft(1, 'VIP', 'L');
            return response()->json([
                'data' => $air->toJson(),
                'msg' => 'THIS IS AN OK MSG',
            ]);
        } catch (Exception $e) {
            return Handler::processException($e);
        }
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     * @author alvaro.assmus@bairesdev.com
     */
    public function enqueue(Request $request): JsonResponse
    {
        try {
            // HERE GOES THE CODE
            return response()->json([
                'name' => 'TODO',
                'state' => 'GUD enqueue',
            ]);
        } catch (Exception $e) {
            return Handler::processException($e);
        }
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     * @author alvaro.assmus@bairesdev.com
     */
    public function dequeue(Request $request): JsonResponse
    {
        try {
            // HERE GOES THE CODE
            return response()->json([
                'name' => 'TODO',
                'state' => 'GUD dequeue',
            ]);
        } catch (Exception $e) {
            return Handler::processException($e);
        }
    }

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     * @author alvaro.assmus@bairesdev.com
     */
    public function list(): JsonResponse
    {
        try {
            // HERE GOES THE CODE
            return response()->json([
                'name' => 'TODO',
                'state' => 'GUD list',
            ]);
        } catch (Exception $e) {
            return Handler::processException($e);
        }
    }

}
