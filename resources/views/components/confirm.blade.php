<article class="rounded-xl bg-white dark:bg-gray-600 shadow-lg row-start-1 lg:row-start-2 mb-6"><h2
        class="text-xl font-semibold text-black dark:text-gray-100 px-6 pt-4">{{ $header }}</h2>
    <p class="pb-6 text-xs text-base text-gray-400 px-6">{{ $subHeader }}</p>
    <div class="w-full flex border-t border-b dark:border-gray-500 py-4 px-6 justify-between">
        {{ $slot }}
    </div>
    <div class="grid grid-cols-2 px-6 py-4 gap-6">
        <a href="{!! $declineRoute !!}"
            class="bg-gray-100 dark:bg-gray-400 py-3 flex justify-center items-center text-black dark:text-white font-medium rounded-lg transition-colors duration-200 hover:bg-gray-200 dark:hover:bg-gray-500">
            <span>Decline</span></a>
        <a href="{!! $acceptRoute !!}"
            class="bg-lime-green-500 py-3 font-medium text-white rounded-lg flex justify-center items-center transition-colors duration-200 hover:bg-lime-green-600">
            <span>Accept</span></a>
    </div>
</article>
