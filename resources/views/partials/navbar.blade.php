<nav class="bg-white dark:bg-gray-800 relative z-10">
    <div class="container px-6 mx-auto md:flex md:justify-between md:items-center">
        <div class="flex items-center justify-between">
            <div>
                <a class="text-2xl font-bold text-gray-800 dark:text-white lg:text-3xl hover:text-gray-700 dark:hover:text-gray-300"
                   href="{{ route('home') }}">WebTech</a>
            </div>

            <div class="flex md:hidden">
                <button type="button"
                        class="text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400"
                        aria-label="toggle menu">
                    <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                        <path fill-rule="evenodd"
                              d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="items-center md:flex h-full">
            <div class="flex flex-col md:flex-row items-center h-full">
                <a href="{{ route('courses.index') }}"
                   class="py-5 px-2 box-border text-sm border-b-4 border-lime-green-400 font-medium text-gray-700 dark:text-gray-200 md:mx-4 md:my-0">Courses</a>
                <a class="my-1 text-sm py-1 px-2 font-medium bg-lime-green-500 rounded hover:bg-lime-green-400 text-white hover:text-white md:ml-4 md:my-0"
                   href="#">{{ auth()->user()->getAuthIdentifierName() }}</a>
            </div>

        </div>
    </div>
</nav>
@isset($breadcrumbs)
<nav class="bg-gray-200 dark:bg-gray-600 relative z-10 dark:border-gray-700 shadow dark:shadow-lg">
    <div class="container px-6 mx-auto py-2">
        <div>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                           class="text-gray-700 dark:text-gray-100 hover:text-gray-900 dark:hover:text-gray-300 inline-flex items-center">
                            <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Home
                        </a>
                    </li>
                    @foreach($breadcrumbs as $breadcrumb => $route)
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                @if(last($breadcrumbs) == $route)
                                    <span
                                        class="text-gray-400 dark:text-gray-400 ml-1 md:ml-2 text-sm font-medium">{{ $breadcrumb }}</span>
                                @else
                                    <a href="{{ $route }}"
                                       class="text-gray-700 dark:text-gray-100 hover:text-gray-900 dark:hover:text-gray-300 ml-1 md:ml-2 text-sm font-medium">{{ $breadcrumb }}</a>

                                @endif
                               </div>
                        </li>
                    @endforeach
                </ol>
            </nav>
        </div>
    </div>
</nav>
@endisset
