<?php

namespace App\Logging;

use Illuminate\Support\Facades\App;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Monolog\LogRecord;
use Monolog\Utils;
use Monolog\Handler\Curl;

class TeamsLogger extends AbstractProcessingHandler
{

    /**
     * @var string The webhook URL provided by Microsoft Teams Workflows
     */
    private string $webhookUrl;

    /**
     * @inheritDoc
     */
    public function __construct(string $webhookUrl, $level = Logger::ERROR, bool $bubble = true)
    {
        parent::__construct($level, $bubble);

        $this->webhookUrl = $webhookUrl;
    }



    /**
     * @inheritDoc
     */
    protected function write(LogRecord|array $record): void
    {
        $postString = $this->createAdaptiveCard($record);

        $ch = curl_init();
        $options = [
            CURLOPT_URL        => $this->webhookUrl,
            CURLOPT_POST       => true,
            CURLOPT_POSTFIELDS => $postString,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            ],
            CURLOPT_RETURNTRANSFER => true,
        ];

        curl_setopt_array($ch, $options);

        Curl\Util::execute($ch);
    }

    /**
     * @param LogRecord $record The log record to create an adaptive card of
     * @return string The json encoded string of the adaptive card.
     */
    private function createAdaptiveCard(LogRecord|array $record): string
    {
        $data = [
            'type'        => 'message',
            'attachments' => [
                [
                    'contentType' => 'application/vnd.microsoft.card.adaptive',
                    'content'     => [
                        '$schema' => 'http://adaptivecards.io/schemas/adaptive-card.json',
                        'type'    => 'AdaptiveCard',
                        'version' => '1.2',
                        'body'    => [
                            [
                                'type' => 'TextBlock',
                                'text' => $record['message'],
                                'wrap' => true,
                            ],
                            [
                                'type'  => 'FactSet',
                                'facts' => [
                                    [
                                        'title' => 'Level',
                                        'value' => $record['level_name'],
                                    ],
                                    [
                                        'title' => 'Time',
                                        'value' => $record['datetime']->format('Y-m-d H:i:s'),
                                    ],
                                    [
                                        'title' => 'Environment',
                                        'value' => App::environment(),
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        return Utils::jsonEncode($data);
    }
}
