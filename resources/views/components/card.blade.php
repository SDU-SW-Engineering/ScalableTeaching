<div {{ $attributes }}>
    <div class="shadow-lg">
        <header
            class="bg-gray-200 dark:bg-gray-900 text-black dark:text-white rounded-t-lg text-lg px-6 py-4 flex justify-between items-center">
            {{ $header }}
            @isset($headerCorner)
                {{ $headerCorner }}
            @endisset
        </header>
        @isset($toolbar)
        <div class="flex bg-gray-200 dark:bg-gray-900 px-6 pb-2 text-xs">
            {{ $toolbar }}
        </div>
        @endisset
        <div class="bg-white dark:bg-gray-600 rounded-b-lg p-6">
            @if(session()->has('success-' . $name))
                <div class="bg-lime-green-200 px-3 py-4 flex rounded mb-4 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-lime-green-500 mr-3" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <div class="text-lime-green-900">
                        <div class="font-medium">
                            {{ session('success-' . $name) }}
                        </div>
                    </div>
                </div>
            @endif
            @if($errors->hasBag($name))
                <div class="bg-red-200 px-3 py-4 flex rounded mb-4 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 mr-3"
                         viewBox="0 0 20 20"
                         fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                              clip-rule="evenodd"/>
                    </svg>
                    <div class="text-red-900">
                        <div class="font-medium">
                            An error occurred
                        </div>
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->getBag($name)->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            {{ $slot }}
        </div>
    </div>
</div>
