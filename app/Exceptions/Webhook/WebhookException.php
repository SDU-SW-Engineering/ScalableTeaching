<?php

namespace App\Exceptions\Webhook;

use App\WebhookTypes;
use Exception;

class WebhookException extends Exception
{
    public function __construct(private WebhookTypes $type){

    }

    /**
     * The status code to use for the response.
     *
     * @var int
     */
    public $status = 422;
}
