<?php

namespace App\Models\Atc;

interface AtcQueueInterface
{
    public function bootAtcSystem(): void;
    public function validateBootStatusIsOn(): void;
    public function enqueueAircraft(Aircraft $aircraft): Aircraft;
    public function dequeueAircraftFromParticularQueue(string $queueName): array;
    public function listAircrafts(): array;
}
