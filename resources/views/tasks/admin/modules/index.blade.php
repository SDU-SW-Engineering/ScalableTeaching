@extends('tasks.admin.master')

@inject('moduleService', 'App\Modules\ModuleService')

@section('adminContent')
    <div class="flex-grow-1 w-full">
        <div class="dark:bg-gray-800 p-4 rounded-lg">
            <h1 class="font-light dark:text-white text-2xl mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-7 h-7 mr-2 text-lime-green-400">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495"/>
                </svg>
                <span>Modules</span>
            </h1>
            <div class="grid grid-cols-2 gap-8">
                @foreach($moduleService->modules() as $module)
                    <div @class(['bg-gray-700 shadow p-4 rounded-md flex flex-col justify-between  border-2', $task->module_configuration->hasInstalled($module) ? ($task->module_configuration->isEnabled($module) ? 'border-lime-green-300' : 'border-yellow-300') : 'border-gray-700'])>
                        <div class="mb-4">
                            <h2 class="text-gray-100 flex gap-2 text-lg items-center mb-4">
                                {!! $module->icon() !!}
                                <span>{{ $module->name() }}</span>
                            </h2>
                            <p class="text-gray-200 font-light text-sm">{{ $module->description() }}</p>
                        </div>
                        <div class="flex justify-between items-center">
                            @if($task->module_configuration->hasInstalled($module))
                                <div class="flex gap-4 items-center">
                                    <button
                                        class="bg-gray-600 px-3 py-2 text-sm font-semibold rounded text-gray-200 transition-colors shadow-sm cursor-not-allowed opacity-50">
                                        Installed
                                    </button>
                                    @if($module->settings() != null)
                                        <a href="{{ route('courses.tasks.admin.modules.configure', [$course, $task, $module->identifier()]) }}"
                                           class="bg-gray-600 px-3 py-2 text-sm font-semibold rounded text-gray-200 transition-colors shadow-sm hover:bg-gray-500">
                                            Configure
                                        </a>
                                    @endif
                                    @if(!$task->module_configuration->isEnabled($module))
                                        <p class="text-yellow-500 font-light text-sm"><span class="mr-1 font-semibold">Configuration
                                                required!</span><span>{{  $missingDependency }}</span></p>
                                    @endif
                                </div>
                                <div>
                                    @if($task->module_configuration->canUninstall($module))
                                        <a href="{{ route('courses.tasks.admin.modules.uninstall', [$course, $task, $module]) }}"
                                           class="bg-red-600 px-3 py-2 text-sm font-semibold rounded text-gray-200 transition-colors shadow-sm hover:bg-red-500">
                                            Uninstall
                                        </a>
                                    @else
                                        <button
                                            class="bg-red-600 px-3 py-2 text-sm font-semibold rounded cursor-not-allowed text-gray-200 transition-colors shadow-sm opacity-50 hover:bg-red-500">
                                            Uninstall
                                        </button>
                                    @endif
                                </div>
                            @else
                                <div class="flex gap-4 items-center">
                                    @if($missingDependency = $moduleService->hasInstallProblems($module::class, $task->module_configuration))
                                        <button
                                            class="bg-gray-600 px-3 py-2 text-sm font-semibold rounded text-gray-200 transition-colors shadow-sm cursor-not-allowed opacity-50">
                                            Install
                                        </button>
                                        <p class="text-red-500 font-light text-sm"><span class="mr-1 font-semibold">Cannot
                                                be
                                                enabled:</span><span>{{  $missingDependency }}</span></p>
                                    @else
                                        <a href="{{ route('courses.tasks.admin.modules.install', [$course, $task, 'module' => $module->identifier()]) }}"
                                           class="bg-gray-600 px-3 py-2 text-sm font-semibold rounded text-gray-200 transition-colors shadow-sm hover:bg-gray-500">
                                            Install
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
