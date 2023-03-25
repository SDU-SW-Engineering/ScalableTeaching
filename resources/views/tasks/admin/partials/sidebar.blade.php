@inject('moduleService', 'App\Modules\ModuleService')

<aside class="w-56 shrink flex-shrink-0 mr-4">
    @unless($task->is_publishable)
        <div class="bg-red-400 text-white flex p-1 rounded mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-8 h-8 text-white mr-1">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
            </svg>
            <div class="flex flex-col">
                <span class="font-bold text-white">Task not publishable</span>
                <span class="text-sm font-semibold">It is missing:</span>
                <ul>
                    @foreach($task->missingFields as $missingField)
                        <li class="text-sm">- {{ $missingField }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endunless
    <x-sidebar-item name="Overview" route="courses.tasks.admin.index" :route-params="[$course, $task]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
        </svg>
    </x-sidebar-item>
    <x-sidebar-item name="Basic Information" route="courses.tasks.admin.preferences"
                    :route-params="[$course, $task]">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor" class="w-5 h-5 text-gray-400">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
        </svg>
    </x-sidebar-item>
    <x-sidebar-item name="Modules" route="courses.tasks.admin.modules.index" :route-params="[$course, $task]">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor" class="h-5 w-5 text-gray-400">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495"/>
        </svg>
    </x-sidebar-item>
    <x-sidebar-item name="Students" route="courses.tasks.admin.students" :route-params="[$course, $task]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M12 14l9-5-9-5-9 5 9 5z"/>
            <path
                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
        </svg>
    </x-sidebar-item>
    <hr class="dark:border-gray-500 my-4">
    @foreach($task->module_configuration->enabled() as $identifier => $moduleModel)
            <?php $module = $task->module_configuration->resolveModule($identifier) ?>
        @if($module->hasSidebar())
            @include("module-$identifier::sidebar")
        @endif
    @endforeach
</aside>
