<?php

namespace App\Modules\PreloadRepositories;

use App\Modules\Module;
use App\Modules\Settings;
use App\Modules\Template\Template;

class PreloadRepositories extends Module
{
    protected string $name = "Preload Repositories";

    protected string $icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-lime-green-300">
  <path fill-rule="evenodd" d="M9.53 2.47a.75.75 0 010 1.06L4.81 8.25H15a6.75 6.75 0 010 13.5h-3a.75.75 0 010-1.5h3a5.25 5.25 0 100-10.5H4.81l4.72 4.72a.75.75 0 11-1.06 1.06l-6-6a.75.75 0 010-1.06l6-6a.75.75 0 011.06 0z" clip-rule="evenodd" />
</svg>';

    protected string $description = "Creates repositories ahead of time. Ideal for tasks with a short timespan (< 24 hours) and many participants, as these can put severe strain on the GitLab server, causing participants to have to wait.";

    protected array $dependencies = [Template::class];



    protected function loadSettings(): ?Settings
    {
        return new PreloadRepositoriesSettings();
    }
}
