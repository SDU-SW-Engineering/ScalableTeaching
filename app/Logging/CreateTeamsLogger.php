<?php

namespace App\Logging;


use Monolog\Logger;

class CreateTeamsLogger
{
    public function __invoke(array $config): Logger
    {
        return new Logger(
            "teams",
            [
                new TeamsLogger(
                    env('TEAMS_WEBHOOK_URL')
                )
            ]
        );
    }

}
