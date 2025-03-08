<?php

namespace Domain\Files;

use Illuminate\Support\Collection;
use Spatie\ShikiPhp\Shiki;
use function Pest\Laravel\call;

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
        $language = $this->convertFileExtToLang($this->filename);

        $highlighted = Shiki::highlight($code, $language);

        $xml = simplexml_load_string($highlighted);
        $lines = $xml->xpath('//span[@class="line"]');

        /** @var Collection<int,HighlightedLine> $processedLines */
        $processedLines = new Collection();
        foreach($lines as $index => $line)
            $processedLines[] = new HighlightedLine($index + 1, $line->asXML());

        return $processedLines;
    }

    /**
     * @param string $fileName
     * @return string
     * Checks if the name of a file and checks of the extension is a known language, if not it attempts to match it to a list of known mappings from file-ext to languages
     */
    private function convertFileExtToLang(string $fileName): string
    {
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        if ((new Shiki)->languageIsAvailable($extension)) {
            return $extension;
        }

        return match ($extension) { // TODO: This should probably be moved to a config file or ideally be configurable from somewhere in the course/task/editor UI
            'cs' => 'csharp',
            'csproj', 'axaml' => 'xml',
            'js' => 'javascript',
            'ts' => 'typescript',
            'py' => 'python',
            'rb' => 'ruby',
            'rs' => 'rust',
            'sh' => 'bash',
            'bat' => 'batch',
            default => 'txt',
        };
    }
}
