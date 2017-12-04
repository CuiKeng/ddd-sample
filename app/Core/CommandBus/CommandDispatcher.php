<?php

declare(strict_types=1);

namespace App\Core\CommandBus;

use Illuminate\Bus\Dispatcher;

class CommandDispatcher extends Dispatcher implements ICommandDispatcher
{

}