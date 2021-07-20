<?php

namespace App\Http\Controllers;

use App\Models\Atc\Aircraft;
use App\Models\Atc\AtcRedisQueue;
use Exception;
use App\Exceptions\Handler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/*LOGIC layer*/

class AtcController extends Controller implements AtcInterface
{

    protected $atcQueue;

    public function __construct(AtcRedisQueue $atcQueue)
    {
        $this->atcQueue = $atcQueue;
    }

    /**
     * This function boots the system to start working, it checks
     * if system is down it turns it on
     * @param Request $request
     * @return JsonResponse
     * @author alvaro.assmus@bairesdev.com
     */
    public function boot(Request $request): JsonResponse
    {
        try {
            $this->atcQueue->bootAtcSystem();
            return response()->json([
                'data' => 'on',
                'msg' => 'SYSTEM BOOTED CORRECTLY',
            ]);
        } catch (Exception $e) {
            return Handler::processException($e);
        }
    }

    /**
     * This function adds an aircraft to the queue
     * @param Request $request
     * @return JsonResponse
     * @author alvaro.assmus@bairesdev.com
     */
    public function enqueue(Request $request): JsonResponse
    {
        try {
            $this->atcQueue->validateBootStatusIsOn();
            $aircraft = new Aircraft(0, $request['aircraft']['type'], $request['aircraft']['size']);
            return response()->json([
                'data' => $this->atcQueue->enqueueAircraft($aircraft)->toJson(),
                'msg' => 'Aircraft added',
            ]);
        } catch (Exception $e) {
            return Handler::processException($e);
        }
    }

    /**
     * This function removes an aircraft from the queue
     * @param Request $request
     * @return JsonResponse
     * @author alvaro.assmus@bairesdev.com
     */
    public function dequeue(Request $request): JsonResponse
    {
        try {
            $this->atcQueue->validateBootStatusIsOn();;
            return response()->json([
                'data' => $this->atcQueue->dequeueAircraft($request['queueName']),
                'msg' => 'Aircraft removed',
            ]);
        } catch (Exception $e) {
            return Handler::processException($e);
        }
    }

    /**
     * Returns the list of aircrafts in the queue
     * @return JsonResponse
     * @author alvaro.assmus@bairesdev.com
     */
    public function list(): JsonResponse
    {
        try {
            $this->atcQueue->validateBootStatusIsOn();
            return response()->json([
                'data' => $this->atcQueue->listAircrafts(),
                'msg' => 'The list of queues',
            ]);
        } catch (Exception $e) {
            \Log::info($e->getTraceAsString());
            return Handler::processException($e);
        }
    }

}
