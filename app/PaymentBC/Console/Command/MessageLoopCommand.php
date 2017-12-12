<?php

namespace App\PaymentBC\Console\Command;

use Illuminate\Console\Command;
use App\PaymentBC\ProcessManager\PaymentProcessManager;
use Illuminate\Support\Str;

class MessageLoopCommand extends Command
{
    private $consumer = [
        'conference-created' => PaymentProcessManager::class . '@handleConferenceCreated'
    ];
    
    protected $signature = 'payment:message:loop';
    
    protected $description = 'Command description';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $connection = app('redis.connection');
        
        $pubsub = $connection->client()->pubSubLoop();
        
        $dispatcher = new \Predis\PubSub\DispatcherLoop($pubsub);
        
        array_walk($this->consumer, function ($consumer, $channel) use ($dispatcher) {
            $dispatcher->attachCallback($channel, function ($payload) use ($consumer) {
                list($class, $method) = Str::parseCallback($consumer);
                call_user_func([app()->make($class), $method], json_decode($payload, true)['data']);
            });
        });
        
        
        $dispatcher->run();
    }
}