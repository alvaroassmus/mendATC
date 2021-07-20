<?php

namespace App\Models\Atc;

use Exception;
use Illuminate\Support\Facades\Redis;

class AtcRedisQueue implements AtcQueueInterface
{
    /**
     * This function finds the next ID for an aircraft in a particular queue
     *
     * @param string $queueName
     * @return int the next id
     * @throws Exception
     * @author alvaro.assmus@bairesdev.com
     */
    private function findNextQueueId(string $queueName): int
    {
        try {
            $newId = 1;
            $keys = Redis::keys($queueName . ':*');
            foreach ($keys as $key) {
                $aircraft = Redis::hgetall(str_replace("mendatc_database_", "", $key));
                $aircraftId = intval($aircraft['id'], 10);
                if ($aircraftId >= $newId) {
                    $newId = ++$aircraftId;
                }
            }
            return $newId;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * This function returns an array with the aircrafts of a particular type and size
     *
     * @param string $queueName
     * @return array
     * @throws Exception
     * @author alvaro.assmus@bairesdev.com
     */
    private function loadAllAircraftsFromParticularQueue(string $queueName): array
    {
        try {
            $queueResult = [];
            $keys = Redis::keys($queueName . ':*');
            foreach ($keys as $key) {
                $redisAircraft = Redis::hgetall(str_replace("mendatc_database_", "", $key));
                $aircraft = new Aircraft(intval($redisAircraft['id'], 10), $redisAircraft['type'], $redisAircraft['size']);
                $queueResult[] = $aircraft->toJson();
            }
            usort($queueResult, function ($a, $b) {
                return $a['id'] <=> $b['id'];
            });
            return $queueResult;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * This function validates if an specific Queue still has Aircrafts to dequeue
     *
     * @param string $queueName
     * @return void
     * @throws Exception
     * @author alvaro.assmus@bairesdev.com
     */
    private function validateIfQueueHasPenddings(string $queueName): void
    {
        try {
            $keys = Redis::keys($queueName . ':*');
            if (count($keys) > 0) {
                throw new Exception("THERE ARE STILL " . $queueName . " AIRCRAFTS TO DEQUEUE", 405);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * This function validates if the EmergencySmallQueue can dequeue an aircraft
     *
     * @return void
     * @throws Exception
     * @author alvaro.assmus@bairesdev.com
     */
    private function validateIfEmergencySmallQueueCanDequeue(): void
    {
        try {
            $this->validateIfQueueHasPenddings('emergencyLarge');
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * This function validates if the VipLargeQueue can dequeue an aircraft
     *
     * @return void
     * @throws Exception
     * @author alvaro.assmus@bairesdev.com
     */
    private function validateIfVipLargeQueueCanDequeue(): void
    {
        try {
            $this->validateIfQueueHasPenddings('emergencyLarge');
            $this->validateIfQueueHasPenddings('emergencySmall');
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * This function validates if the VipSmallQueue can dequeue an aircraft
     *
     * @return void
     * @throws Exception
     * @author alvaro.assmus@bairesdev.com
     */
    private function validateIfVipSmallQueueCanDequeue(): void
    {
        try {
            $this->validateIfQueueHasPenddings('emergencyLarge');
            $this->validateIfQueueHasPenddings('emergencySmall');
            $this->validateIfQueueHasPenddings('vipLarge');
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * This function validates if the PeopleLargeQueue can dequeue an aircraft
     *
     * @return void
     * @throws Exception
     * @author alvaro.assmus@bairesdev.com
     */
    private function validateIfPeopleLargeQueueCanDequeue(): void
    {
        try {
            $this->validateIfQueueHasPenddings('emergencyLarge');
            $this->validateIfQueueHasPenddings('emergencySmall');
            $this->validateIfQueueHasPenddings('vipLarge');
            $this->validateIfQueueHasPenddings('vipSmall');
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * This function validates if the PeopleSmallQueue can dequeue an aircraft
     *
     * @return void
     * @throws Exception
     * @author alvaro.assmus@bairesdev.com
     */
    private function validateIfPeopleSmallQueueCanDequeue(): void
    {
        try {
            $this->validateIfQueueHasPenddings('emergencyLarge');
            $this->validateIfQueueHasPenddings('emergencySmall');
            $this->validateIfQueueHasPenddings('vipLarge');
            $this->validateIfQueueHasPenddings('vipSmall');
            $this->validateIfQueueHasPenddings('peopleLarge');
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * This function validates if the CargoLargeQueue can dequeue an aircraft
     *
     * @return void
     * @throws Exception
     * @author alvaro.assmus@bairesdev.com
     */
    private function validateIfCargoLargeQueueCanDequeue(): void
    {
        try {
            $this->validateIfQueueHasPenddings('emergencyLarge');
            $this->validateIfQueueHasPenddings('emergencySmall');
            $this->validateIfQueueHasPenddings('vipLarge');
            $this->validateIfQueueHasPenddings('vipSmall');
            $this->validateIfQueueHasPenddings('peopleLarge');
            $this->validateIfQueueHasPenddings('peopleSmall');
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * This function validates if the CargoSmallQueue can dequeue an aircraft
     *
     * @return void
     * @throws Exception
     * @author alvaro.assmus@bairesdev.com
     */
    private function validateIfCargoSmallQueueCanDequeue(): void
    {
        try {
            $this->validateIfQueueHasPenddings('emergencyLarge');
            $this->validateIfQueueHasPenddings('emergencySmall');
            $this->validateIfQueueHasPenddings('vipLarge');
            $this->validateIfQueueHasPenddings('vipSmall');
            $this->validateIfQueueHasPenddings('peopleLarge');
            $this->validateIfQueueHasPenddings('peopleSmall');
            $this->validateIfQueueHasPenddings('cargoLarge');
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * This function initialize the system
     *
     * @return void
     * @throws Exception
     * @author alvaro.assmus@bairesdev.com
     */
    public function bootAtcSystem(): void
    {
        try {
            if (!isset($atcIsOn) || $atcIsOn !== 'on') {
                Redis::set('AtcIsOn', 'on');
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * This function validates that the system is initialized
     * if not, throws an exception
     *
     * @return void
     * @throws Exception it throws an exception if the system has not been booted
     * @author alvaro.assmus@bairesdev.com
     */
    public function validateBootStatusIsOn(): void
    {
        try {
            $atcIsOn = Redis::get('AtcIsOn');
            if (!isset($atcIsOn) || $atcIsOn !== 'on') {
                throw new Exception('You must initialize the system before using it. ERR_ATCQ_BAS', 403);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * This function adds an aircraft to the respective queue
     * depending on the aircraft size and type
     *
     * @param Aircraft $aircraft
     * @return Aircraft
     * @throws Exception
     * @author alvaro.assmus@bairesdev.com
     */
    public function enqueueAircraft(Aircraft $aircraft): Aircraft
    {
        try {
            if ($aircraft->getType() === 'E' && $aircraft->getSize() === 'L') {
                $queueName = 'emergencyLarge';
            } elseif ($aircraft->getType() === 'E' && $aircraft->getSize() === 'S') {
                $queueName = 'emergencySmall';
            } elseif ($aircraft->getType() === 'V' && $aircraft->getSize() === 'L') {
                $queueName = 'vipLarge';
            } elseif ($aircraft->getType() === 'V' && $aircraft->getSize() === 'S') {
                $queueName = 'vipSmall';
            } elseif ($aircraft->getType() === 'P' && $aircraft->getSize() === 'L') {
                $queueName = 'peopleLarge';
            } elseif ($aircraft->getType() === 'P' && $aircraft->getSize() === 'S') {
                $queueName = 'peopleSmall';
            } elseif ($aircraft->getType() === 'C' && $aircraft->getSize() === 'L') {
                $queueName = 'cargoLarge';
            } elseif ($aircraft->getType() === 'C' && $aircraft->getSize() === 'S') {
                $queueName = 'cargoSmall';
            } else {
                throw new Exception("THE TYPE (" . $aircraft->getType() . ") AND SIZE (" . $aircraft->getSize() . ") AIRCRAFT DOES NOT EXIST IN THE SYSTEM. ERR_AQ_EA", 500);
            }
            $nextId = $this->findNextQueueId($queueName);
            $aircraft->setId($nextId);
            Redis::hmset($queueName . ':' . $nextId, [
                'id' => $aircraft->getId(),
                'type' => $aircraft->getType(),
                'size' => $aircraft->getSize()
            ]);
            return $aircraft;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * This function removes an aircraft from the respective received queue
     *
     * @param string $queueName
     * @return array
     * @throws Exception
     * @author alvaro.assmus@bairesdev.com
     */
    public function dequeueAircraftFromParticularQueue(string $queueName): array
    {
        try {
            if ($queueName === 'emergencySmall') {
                $this->validateIfEmergencySmallQueueCanDequeue();
            } elseif ($queueName === 'vipLarge') {
                $this->validateIfVipLargeQueueCanDequeue();
            } elseif ($queueName === 'vipSmall') {
                $this->validateIfVipSmallQueueCanDequeue();
            } elseif ($queueName === 'peopleLarge') {
                $this->validateIfPeopleLargeQueueCanDequeue();
            } elseif ($queueName === 'peopleSmall') {
                $this->validateIfPeopleSmallQueueCanDequeue();
            } elseif ($queueName === 'cargoLarge') {
                $this->validateIfCargoLargeQueueCanDequeue();
            } elseif ($queueName === 'cargoSmall') {
                $this->validateIfCargoSmallQueueCanDequeue();
            } else {
                throw new Exception("THE REQUESTED QUEUE (" . $queueName . ") DOES NOT EXIST IN THE SYSTEM. ERR_AQ_DA", 500);
            }
            $redisQueue = $this->loadAllAircraftsFromParticularQueue($queueName);
            if (count($redisQueue) === 0) {
                throw new Exception("The selected QUEUE has no aircrafts to dequeue", 406);
            } else {
                $queueAircraft = array_shift($redisQueue);
                Redis::del($queueName . ":" . $queueAircraft['id']);
            }
            return $queueAircraft;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * This function returns the list of all the queues of the system
     *
     * @return array
     * @throws Exception
     * @author alvaro.assmus@bairesdev.com
     */
    public function listAircrafts(): array
    {
        try {
            $emergencyLarge = $this->loadAllAircraftsFromParticularQueue('emergencyLarge');
            $emergencySmall = $this->loadAllAircraftsFromParticularQueue('emergencySmall');
            $vipLarge = $this->loadAllAircraftsFromParticularQueue('vipLarge');
            $vipSmall = $this->loadAllAircraftsFromParticularQueue('vipSmall');
            $peopleLarge = $this->loadAllAircraftsFromParticularQueue('peopleLarge');
            $peopleSmall = $this->loadAllAircraftsFromParticularQueue('peopleSmall');
            $cargoLarge = $this->loadAllAircraftsFromParticularQueue('cargoLarge');
            $cargoSmall = $this->loadAllAircraftsFromParticularQueue('cargoSmall');
            return ['emergencyLarge' => $emergencyLarge, 'emergencySmall' => $emergencySmall,
                'vipLarge' => $vipLarge, 'vipSmall' => $vipSmall,
                'peopleLarge' => $peopleLarge, 'peopleSmall' => $peopleSmall,
                'cargoLarge' => $cargoLarge, 'cargoSmall' => $cargoSmall];
        } catch (Exception $e) {
            throw $e;
        }
    }
}
