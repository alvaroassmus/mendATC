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
            if(!isset($request['type']) || $request['type'] === '') {
                throw new Exception("The type is required", 400);
            }
            if(!isset($request['size']) || $request['size'] === '') {
                throw new Exception("The size is required", 400);
            }
            $aircraft = new Aircraft($request['type'], $request['size']);
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
            $this->atcQueue->validateBootStatusIsOn();
            if(!isset($request['queueName']) || $request['queueName'] === '') {
                throw new Exception("The queueName is required", 400);
            }
            return response()->json([
                'data' => $this->atcQueue->dequeueAircraftFromParticularQueue($request['queueName']),
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
            return Handler::processException($e);
        }
    }

}
