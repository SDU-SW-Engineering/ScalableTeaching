<?php

namespace App;

enum WebhookTypes : string
{
    case Job = "job";
    case Pipeline = "pipeline";
    case Unknown = "unknown";
}
