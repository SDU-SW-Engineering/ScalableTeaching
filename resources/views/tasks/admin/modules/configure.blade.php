@extends('tasks.admin.master')

@inject('moduleService', 'App\Modules\ModuleService')

@section('adminContent')
    <form class="flex-grow-1 w-full" method="POST"
          action="{{ route('courses.tasks.admin.modules.do-configure', [$course, $task, $module]) }}">
        @csrf
        <div class="dark:bg-gray-800 p-4 rounded-lg">
            <h1 class="font-light dark:text-white text-2xl mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-7 h-7 mr-2 text-lime-green-400">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495"/>
                </svg>
                <span>Modules</span>
            </h1>
            <div @class(['bg-gray-700 shadow p-4 rounded-md flex flex-col justify-between'])>
                <div class="">
                    <div class="flex justify-between">
                        <div>
                            <h2 class="text-gray-100 flex gap-2 text-lg items-center mb-4">
                                {!! $module->icon() !!}
                                <span>{{ $module->name() }}</span>
                            </h2>
                            <p class="text-gray-200 font-light text-sm">{{ $module->description() }}</p>
                        </div>
                        <div class="flex-shrink-0">
                            <a href="{{ route('courses.tasks.admin.modules.index', [$course, $task]) }}"
                               class="text-gray-100 ">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                     class="w-6 h-6">
                                    <path fill-rule="evenodd"
                                          d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div>
                        @include('module-' . $module->identifier() . '::configure')
                    </div>
                    <div class="mt-4 flex items-center gap-4">
                        <button type="submit"
                                href="{{ route('courses.tasks.admin.modules.configure', [$course, $task, $module->identifier()]) }}"
                                class="bg-gray-600 px-3.5 py-2.5 text-sm font-semibold rounded text-gray-200 transition-colors shadow-sm hover:bg-gray-500">
                            Save changes
                        </button>
                        @if($errors->any())
                            <span class="text-red-500 text-sm font-semibold">{{ $errors->first() }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
