@extends('master')

@section('content')
    <div class="container mx-auto px-6 pt-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-6 items-start">
            <section
                class="rounded-xl bg-white dark:bg-gray-600 px-4 sm:px-6 lg:px-4 xl:px-6 pt-4 pb-4 sm:pb-6 lg:pb-4 xl:pb-6 space-y-4 shadow-lg row-start-2 lg:col-start-1 xl:col-span-2 2xl:col-span-3">
                <header class="flex items-center justify-between">
                    <h2 class="text-lg leading-6 font-medium text-black dark:text-gray-100">My Groups</h2>
                    <button
                        class="hover:bg-lime-green-200 hover:text-light-blue-800 group flex items-center rounded-md bg-lime-green-100 text-lime-green-700 text-sm font-medium px-4 py-2">
                        <svg class="group-hover:text-lime-green-700 text-lime-green-600 mr-2" width="12" height="20"
                             fill="currentColor">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M6 5a1 1 0 011 1v3h3a1 1 0 110 2H7v3a1 1 0 11-2 0v-3H2a1 1 0 110-2h3V6a1 1 0 011-1z"/>
                        </svg>
                        New
                    </button>
                </header>
                <form class="relative">
                    <svg width="20" height="20" fill="currentColor"
                         class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"/>
                    </svg>
                    <input
                        class="dark:bg-gray-700 focus:border-lime-green-300 bg-gray-100 focus:ring-1 focus:ring-lime-green-300 focus:outline-none w-full text-sm text-black dark:text-gray-200 placeholder-gray-500 border dark:border-gray-600 border-gray-200 rounded-md py-2 pl-10"
                        type="text" aria-label="Filter projects" placeholder="Filter projects"/>
                </form>
                <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-4">
                    @foreach(range(1,3) as $i)
                        <li>
                            <a href="#"
                               class="hover:bg-lime-green-500 hover:border-transparent hover:shadow-lg group block rounded-lg p-4 border border-gray-200 dark:border-gray-500">
                                <dl class="grid sm:block lg:grid xl:block grid-cols-2 grid-rows-2 items-center">
                                    <div>
                                        <dt class="sr-only">Title</dt>
                                        <dd class="group-hover:text-white leading-6 font-medium text-black dark:text-white">
                                            Gruppe 11
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="sr-only">Category</dt>
                                        <dd class="group-hover:text-lime-green-200 text-sm font-medium sm:mb-4 lg:mb-0 xl:mb-4 text-gray-500 dark:text-gray-400">
                                            22 Members
                                        </dd>
                                    </div>
                                    <div class="col-start-2 row-start-1 row-end-3">
                                        <dt class="sr-only">Users</dt>
                                        <dd class="flex justify-end sm:justify-start lg:justify-end xl:justify-start -space-x-2">
                                            @foreach(range(1,3) as $index)
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="w-7 h-7 rounded-full bg-gray-100 border-2 border-white"
                                                     height="48" width="48" fill="none" viewBox="0 0 24 24"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            @endforeach
                                        </dd>
                                    </div>
                                </dl>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>
            <article class="rounded-xl bg-white dark:bg-gray-600 shadow-lg row-start-1 lg:row-start-2">
                <h2 class="text-xl font-semibold text-black dark:text-gray-100 px-6 pt-4">Group Invitation</h2>
                <p class="pb-6 text-xs text-base text-gray-400 px-6">
                    Group 11
                </p>
                <div class="w-full flex border-t border-b dark:border-gray-500 py-4 justify-between">
                    <dt class="pl-6 w-2/5 uppercase font-semibold tracking-wide text-sm text-gray-600 dark:text-gray-100">Members</dt>
                    <div class="pr-6">
                        @foreach(range(1,3) as $index)
                            <dd class="text-sm sm:text-base font-medium text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 rounded-full py-1 pl-4 pr-4 flex items-center mb-4 last:mb-0">
                                Andrew Parsons
                            </dd>
                        @endforeach
                    </div>
                </div>
                <div class="grid grid-cols-2 px-6 py-4 gap-6">
                    <button class="bg-gray-100 dark:bg-gray-400 py-3 text-black dark:text-white font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-500 transition-colors duration-200">Decline</button>
                    <button class="bg-lime-green-500 py-3 font-medium text-white rounded-lg hover:bg-lime-green-600 transition-colors duration-200">Accept</button>
                </div>
            </article>
        </div>
    </div>
@endsection
