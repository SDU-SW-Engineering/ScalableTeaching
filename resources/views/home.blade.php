@extends('master')

@section('content')
    <section>
        <nav class="container p-6 mx-auto lg:flex lg:justify-between lg:items-center">
            <div class="flex items-center justify-between">
                <div>
                    <a class="text-2xl font-bold text-gray-800 dark:text-white lg:text-3xl hover:text-gray-700 dark:hover:text-gray-300"
                       href="#">WebTech</a>
                </div>

                <!-- Mobile menu button -->
                <div class="flex lg:hidden">
                    <button @click="show = !show" type="button"
                            class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600"
                            aria-label="toggle menu">
                        <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                            <path fill-rule="evenodd"
                                  d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
            <div class="flex flex-col mt-4 space-y-2 lg:mt-0 lg:flex-row lg:space-x-16 lg:space-y-0"
                 :class="{'hidden': !show}">
                <a class="text-gray-700 dark:text-gray-200 dark:hover:text-lime-green-400 hover:text-lime-green-500"
                   href="{{ route('courses.index') }}">Courses</a>
                <a class="text-gray-700 dark:text-gray-200 dark:hover:text-lime-green-400 hover:text-lime-green-500"
                   href="#">Assignments</a>
                <a class="text-gray-700 dark:text-gray-200 dark:hover:text-lime-green-400 hover:text-lime-green-500"
                   href="#">Groups</a>

            </div>
            <a class="block px-5 py-2 mt-4 font-medium leading-5 text-center text-white hover:text-white capitalize bg-lime-green-500 rounded-lg lg:mt-0 hover:bg-lime-green-400 lg:w-auto"
               href="#">
                @auth
                    Dashboard
                @else
                    Login
                @endauth
            </a>
        </nav>

        <div class="container px-6 py-16 mx-auto text-center bg-gray-100 rounded-xl shadow-lg bg-blob"
             style="background-position: 50% 60%; background-size: cover;">
            <div class="max-w-lg mx-auto">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white md:text-4xl">Assignment Tracking</h1>
                <p class="mt-6 text-gray-500 dark:text-gray-300">Lorem ipsum dolor sit, amet consectetur adipisicing
                    elit. Libero similique
                    obcaecati illum mollitia.</p>
                <button
                    class="px-6 py-2 mt-6 text-sm font-medium leading-5 text-center text-white capitalize bg-lime-green-400 rounded-lg hover:bg-lime-green-300 md:mx-0 md:w-auto focus:outline-none shadow-lg">
                    Get Started Now
                </button>
            </div>

        </div>
    </section>
    <section class="bg-white dark:bg-gray-800">
        <div class="container px-6 py-8 mx-auto">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <div>
                    <svg class="w-8 h-8" viewBox="0 0 30 30" fill="none">
                        <path
                            d="M29.6931 14.2283L22.7556 6.87823C22.3292 6.426 21.6175 6.40538 21.1652 6.83212C20.7137 7.25851 20.6927 7.9706 21.1195 8.42248L27.3284 15L21.1195 21.5783C20.6927 22.0302 20.7137 22.7419 21.1652 23.1687C21.3827 23.3738 21.6606 23.4754 21.9374 23.4754C22.2363 23.4754 22.5348 23.3569 22.7557 23.1233L29.6932 15.7729C30.1022 15.339 30.1023 14.6618 29.6931 14.2283Z"
                            fill="#2D3748"/>
                        <path
                            d="M8.88087 21.578L2.67236 15L8.88087 8.42215C9.30726 7.97028 9.28664 7.25812 8.83476 6.83179C8.38323 6.4054 7.67073 6.42603 7.2444 6.87791L0.306858 14.2279C-0.102245 14.6614 -0.102245 15.3391 0.306858 15.7726L7.24475 23.123C7.466 23.3574 7.76413 23.4755 8.06302 23.4755C8.33976 23.4755 8.61767 23.3735 8.83476 23.1684C9.28705 22.742 9.30726 22.0299 8.88087 21.578Z"
                            fill="#2D3748"/>
                        <path
                            d="M16.8201 3.08774C16.2062 2.99476 15.6317 3.41622 15.5379 4.03011L12.2379 25.6302C12.1441 26.2445 12.566 26.8186 13.1803 26.9124C13.238 26.921 13.295 26.9252 13.3516 26.9252C13.898 26.9252 14.3773 26.5266 14.4624 25.97L17.7624 4.3699C17.8562 3.7556 17.4343 3.1815 16.8201 3.08774Z"
                            fill="#4299E1"/>
                    </svg>

                    <h1 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">Default Taiwindcss Config</h1>

                    <p class="mt-2 text-gray-500 dark:text-gray-400">Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Dignissim fusce tortor, ac sed malesuada blandit. Et mi gravida sem feugiat.</p>
                </div>

                <div>
                    <svg class="w-8 h-8" viewBox="0 0 30 30" fill="none">
                        <path
                            d="M27.3633 7.08984H26.4844V6.21094C26.4844 4.75705 25.3015 3.57422 23.8477 3.57422H4.39453C2.94064 3.57422 1.75781 4.75705 1.75781 6.21094V21.1523H0.878906C0.393516 21.1523 0 21.5459 0 22.0312V23.7891C0 25.2429 1.18283 26.4258 2.63672 26.4258H27.3633C28.8172 26.4258 30 25.2429 30 23.7891V9.72656C30 8.27268 28.8172 7.08984 27.3633 7.08984ZM3.51562 6.21094C3.51562 5.72631 3.9099 5.33203 4.39453 5.33203H23.8477C24.3323 5.33203 24.7266 5.72631 24.7266 6.21094V7.08984H20.332C18.8781 7.08984 17.6953 8.27268 17.6953 9.72656V21.1523H3.51562V6.21094ZM1.75781 23.7891V22.9102H17.6953V23.7891C17.6953 24.0971 17.7489 24.3929 17.8465 24.668H2.63672C2.15209 24.668 1.75781 24.2737 1.75781 23.7891ZM28.2422 23.7891C28.2422 24.2737 27.8479 24.668 27.3633 24.668H20.332C19.8474 24.668 19.4531 24.2737 19.4531 23.7891V9.72656C19.4531 9.24193 19.8474 8.84766 20.332 8.84766H27.3633C27.8479 8.84766 28.2422 9.24193 28.2422 9.72656V23.7891Z"
                            fill="#2D3748"/>
                        <path
                            d="M24.7266 21.1523H22.9688C22.4834 21.1523 22.0898 21.5459 22.0898 22.0312C22.0898 22.5166 22.4834 22.9102 22.9688 22.9102H24.7266C25.212 22.9102 25.6055 22.5166 25.6055 22.0312C25.6055 21.5459 25.212 21.1523 24.7266 21.1523Z"
                            fill="#4299E1"/>
                        <path
                            d="M23.8477 12.3633C24.3331 12.3633 24.7266 11.9698 24.7266 11.4844C24.7266 10.999 24.3331 10.6055 23.8477 10.6055C23.3622 10.6055 22.9688 10.999 22.9688 11.4844C22.9688 11.9698 23.3622 12.3633 23.8477 12.3633Z"
                            fill="#4299E1"/>
                    </svg>

                    <h1 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">Fully Responsive
                        Components</h1>

                    <p class="mt-2 text-gray-500 dark:text-gray-400">Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Dignissim fusce tortor, ac sed malesuada blandit. Et mi gravida sem feugiat.</p>
                </div>

                <div>
                    <svg class="h-8 w-8 text-lime-green-600 dark:text-lime-green-500 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <h1 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">Average Queue Time</h1>

                    <p class="mt-2 text-gray-500 dark:text-gray-400">Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Dignissim fusce tortor, ac sed malesuada blandit. Et mi gravida sem feugiat.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
