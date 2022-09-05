<?php

namespace Domain\Management;

enum Permissions: int
{
    case Read = 0;
    case Write = 1;
    case Delete = 2;
}
