<?php

namespace App;

enum ProjectStatus: string
{
    case Active = 'active';
    case Overdue = 'overdue';
    case Finished = 'finished';
}
