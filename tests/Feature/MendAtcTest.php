<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Redis;

class MendAtcTest extends TestCase
{
    public function testWelcomePageIsUp()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testValidateBootStatusFunction()
    {
        Redis::flushdb();
        $response = $this->post('/list');
        $response->assertStatus(403);
    }

    public function testBootRestApi()
    {
        $response = $this->post('/boot');
        $response->assertStatus(200);
    }

    public function testEnqueueRestApi()
    {
        $testAircraft = [
            'type' => 'E',
            'size' => 'L'
        ];
        $response = $this->post('/enqueue', $testAircraft);
        $response->assertStatus(200);
    }

    public function testEnqueueMandatorySizeField()
    {
        $testAircraft = [
            'type' => 'E'
        ];
        $response = $this->post('/enqueue', $testAircraft);
        $response->assertStatus(400);
    }

    public function testEnqueueMandatoryTypeField()
    {
        $testAircraft = [
            'size' => 'L'
        ];
        $response = $this->post('/enqueue', $testAircraft);
        $response->assertStatus(400);
    }

    public function testDequeueMandatoryQueueNameField()
    {
        $testQueueName = [];
        $response = $this->post('/dequeue', $testQueueName);
        $response->assertStatus(400);
    }

    public function testDequeueRestApi()
    {
        $testQueueName = [
            'queueName' => 'emergencyLarge'
        ];
        $response = $this->post('/dequeue', $testQueueName);
        $response->assertStatus(200) ? $response->assertStatus(200) : $response->assertStatus(406);
    }

    public function testListRestApi()
    {
        $response = $this->post('/list');
        $response->assertStatus(200);
    }
}
