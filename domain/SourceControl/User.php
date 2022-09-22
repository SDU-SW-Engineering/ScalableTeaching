<?php

namespace Domain\SourceControl;

class User
{
    public function __construct(public string|int $id, public string $name)
    {
    }

    public static function token(string $user = 'default') : string
    {
        return config("sourcecontrol.users.$user.token");
    }
}
