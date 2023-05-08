<?php

namespace App\Modules\PlagiarismDetection;

use App\Modules\AutomaticDownload\AutomaticDownload;
use App\Modules\Module;
use App\Modules\Settings;
use App\Modules\Template\Template;
use Illuminate\Support\Facades\Route;

class PlagiarismDetection extends Module
{
    protected string $name = "Plagiarism Detection";

    protected string $icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-lime-green-300">
  <path fill-rule="evenodd" d="M17.663 3.118c.225.015.45.032.673.05C19.876 3.298 21 4.604 21 6.109v9.642a3 3 0 01-3 3V16.5c0-5.922-4.576-10.775-10.384-11.217.324-1.132 1.3-2.01 2.548-2.114.224-.019.448-.036.673-.051A3 3 0 0113.5 1.5H15a3 3 0 012.663 1.618zM12 4.5A1.5 1.5 0 0113.5 3H15a1.5 1.5 0 011.5 1.5H12z" clip-rule="evenodd" />
  <path d="M3 8.625c0-1.036.84-1.875 1.875-1.875h.375A3.75 3.75 0 019 10.5v1.875c0 1.036.84 1.875 1.875 1.875h1.875A3.75 3.75 0 0116.5 18v2.625c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625v-12z" />
  <path d="M10.5 10.5a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963 5.23 5.23 0 00-3.434-1.279h-1.875a.375.375 0 01-.375-.375V10.5z" />
</svg>';

    protected string $description = "Validates each repository for overlap between hand-ins and generates a report after the deadline of a project.";

    protected array $dependencies = [Template::class, AutomaticDownload::class];

    protected function loadSettings(): ?Settings
    {
        return new PlagiarismDetectionSettings();
    }

    public static function configRoutes(): void
    {
        Route::get('/', [Controller::class, 'dashboard'])->name('dashboard');
        Route::get('project/{project}/{overlap?}', [Controller::class, 'details'])->name('details');
        Route::get('files', [Controller::class, 'files'])->name('files');
        Route::post('files', [Controller::class, 'hideFiles']);
        Route::get('compare/{from}', [Controller::class, 'compare'])->name('compare');
        Route::get('compare/{from}/details', [Controller::class, 'compareDetails'])->name('compareDetails');
    }
}
