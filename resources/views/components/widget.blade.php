<div>
    <div class="w-full">
        <div class="flex shadow-lg bg-gray-200 dark:bg-gray-700 rounded-md px-5 py-5">
            <div
                class="flex w-10 h-10 bg-lime-green-200 justify-center items-center rounded-lg text-lime-green-800 mr-5">
                {{ $icon }}
            </div>
            <div class="flex flex-col flex-grow -mt-1">
                <span class="-mb-1 text-sm font-semibold text-gray-500 dark:text-gray-400">{{ $title }}</span>
                <div>
                    <span class="text-5xl text-gray-600 font-bold dark:text-gray-100">{{ $slot }}</span>
                    <span class="text-gray-400 text-sm font-semibold">{{ $secondary }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
