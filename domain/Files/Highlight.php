<?php

namespace Domain\Files;

use Illuminate\Support\Collection;
use Spatie\ShikiPhp\Shiki;

class Highlight
{
    public function __construct(public string $filename)
    {

    }

    /**
     * @param string $code
     * @return Collection<int,HighlightedLine> |null
     */
    public function code(string $code): ?Collection
    {
        $extension = pathinfo($this->filename, PATHINFO_EXTENSION);
        try {
            $highlighted = Shiki::highlight($code, $extension);
        } catch(\Exception $e) {
            try {
                $highlighted = Shiki::highlight($code, 'txt');
            } catch(\Exception $e2) {
                return null;
            }
        }

        $xml = simplexml_load_string($highlighted);
        $lines = $xml->xpath('//span[@class="line"]');
        /** @var Collection<int,HighlightedLine> $processedLines */
        $processedLines = new Collection();
        foreach($lines as $index => $line)
            $processedLines[] = new HighlightedLine($index + 1, $line->asXML());

        return $processedLines;
    }
}
