@extends('master')

@section('content')
    <section class="bg-gray-100 dark:bg-gray-800 relative">
        @if(session()->has('error'))
        <div class="bg-red-100 rounded-lg p-4 mb-4 text-sm text-red-700 absolute" style="left: 50%; transform: translateX(-50%);" role="alert">
            {{ session('error') }}
        </div>
        @endif
        <nav class="container p-6 mx-auto lg:flex lg:justify-between lg:items-center">
            <div class="flex items-center justify-between">
                <div>
                    <a class=""
                       href="{{ route('home') }}">
                        <svg width="100%" height="100%" viewBox="0 0 1179 122" version="1.1" class="fill-current text-gray-800   dark:text-white"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             xml:space="preserve"
                             style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;height: 25px;margin-top:4px">
    <g transform="matrix(1,0,0,1,-73.9597,-87.9925)">
        <g transform="matrix(125.644,0,0,125.644,200,178.072)">
            <path
                d="M0.32,0.017C0.5,0.017 0.617,-0.077 0.617,-0.214C0.617,-0.337 0.529,-0.415 0.351,-0.436C0.274,-0.445 0.24,-0.459 0.24,-0.501C0.24,-0.54 0.274,-0.565 0.34,-0.565C0.395,-0.565 0.456,-0.55 0.528,-0.517L0.587,-0.662C0.495,-0.703 0.425,-0.717 0.333,-0.717C0.165,-0.717 0.056,-0.629 0.056,-0.493C0.056,-0.371 0.138,-0.304 0.32,-0.286C0.406,-0.277 0.43,-0.251 0.43,-0.213C0.43,-0.167 0.391,-0.144 0.317,-0.144C0.254,-0.144 0.181,-0.166 0.106,-0.212L0.035,-0.061C0.128,-0.003 0.221,0.017 0.32,0.017Z"
                style="fill-rule:nonzero;"/>
        </g>
        <g transform="matrix(125.644,0,0,125.644,280.413,178.072)">
            <path
                d="M0.307,0.011C0.375,0.011 0.437,-0.009 0.494,-0.049L0.417,-0.172C0.388,-0.148 0.356,-0.135 0.317,-0.135C0.251,-0.135 0.209,-0.18 0.209,-0.249C0.209,-0.314 0.253,-0.359 0.321,-0.359C0.351,-0.359 0.383,-0.35 0.411,-0.329L0.484,-0.454C0.436,-0.488 0.373,-0.505 0.308,-0.505C0.14,-0.505 0.029,-0.402 0.029,-0.245C0.029,-0.087 0.135,0.011 0.307,0.011Z"
                style="fill-rule:nonzero;"/>
        </g>
        <g transform="matrix(125.644,0,0,125.644,343.486,178.072)">
            <path
                d="M0.27,-0.506C0.194,-0.506 0.135,-0.495 0.061,-0.468L0.091,-0.346C0.146,-0.363 0.195,-0.373 0.243,-0.373C0.314,-0.373 0.343,-0.349 0.343,-0.292L0.343,-0.291C0.314,-0.303 0.271,-0.312 0.226,-0.312C0.107,-0.312 0.027,-0.251 0.027,-0.15C0.027,-0.056 0.095,0.009 0.196,0.009C0.279,0.009 0.338,-0.037 0.36,-0.094L0.363,-0.094C0.358,-0.048 0.357,-0.023 0.357,-0L0.524,-0L0.524,-0.31C0.524,-0.445 0.442,-0.506 0.27,-0.506ZM0.26,-0.127C0.227,-0.127 0.207,-0.142 0.207,-0.168C0.207,-0.195 0.227,-0.212 0.265,-0.212C0.291,-0.212 0.322,-0.204 0.345,-0.195C0.338,-0.153 0.306,-0.127 0.26,-0.127Z"
                style="fill-rule:nonzero;"/>
        </g>
        <g transform="matrix(125.644,0,0,125.644,415.983,178.072)">
            <path
                d="M0.216,0.012C0.265,0.012 0.324,0.002 0.358,-0.019L0.329,-0.145C0.312,-0.138 0.297,-0.135 0.28,-0.135C0.251,-0.135 0.24,-0.156 0.24,-0.186L0.24,-0.7L0.058,-0.7L0.058,-0.161C0.058,-0.047 0.111,0.012 0.216,0.012Z"
                style="fill-rule:nonzero;"/>
        </g>
        <g transform="matrix(125.644,0,0,125.644,461.34,178.072)">
            <path
                d="M0.27,-0.506C0.194,-0.506 0.135,-0.495 0.061,-0.468L0.091,-0.346C0.146,-0.363 0.195,-0.373 0.243,-0.373C0.314,-0.373 0.343,-0.349 0.343,-0.292L0.343,-0.291C0.314,-0.303 0.271,-0.312 0.226,-0.312C0.107,-0.312 0.027,-0.251 0.027,-0.15C0.027,-0.056 0.095,0.009 0.196,0.009C0.279,0.009 0.338,-0.037 0.36,-0.094L0.363,-0.094C0.358,-0.048 0.357,-0.023 0.357,-0L0.524,-0L0.524,-0.31C0.524,-0.445 0.442,-0.506 0.27,-0.506ZM0.26,-0.127C0.227,-0.127 0.207,-0.142 0.207,-0.168C0.207,-0.195 0.227,-0.212 0.265,-0.212C0.291,-0.212 0.322,-0.204 0.345,-0.195C0.338,-0.153 0.306,-0.127 0.26,-0.127Z"
                style="fill-rule:nonzero;"/>
        </g>
        <g transform="matrix(125.644,0,0,125.644,533.837,178.072)">
            <path
                d="M0.385,0.011C0.515,0.011 0.613,-0.096 0.613,-0.25C0.613,-0.41 0.519,-0.505 0.396,-0.505C0.319,-0.505 0.256,-0.46 0.223,-0.4L0.22,-0.4C0.239,-0.474 0.242,-0.528 0.242,-0.595L0.242,-0.7L0.058,-0.7L0.058,-0L0.22,-0C0.22,-0.02 0.22,-0.041 0.217,-0.079L0.22,-0.079C0.252,-0.023 0.311,0.011 0.385,0.011ZM0.333,-0.136C0.273,-0.136 0.236,-0.181 0.236,-0.249C0.236,-0.314 0.277,-0.358 0.335,-0.358C0.395,-0.358 0.433,-0.312 0.433,-0.245C0.433,-0.179 0.391,-0.136 0.333,-0.136Z"
                style="fill-rule:nonzero;"/>
        </g>
        <g transform="matrix(125.644,0,0,125.644,614.501,178.072)">
            <path
                d="M0.216,0.012C0.265,0.012 0.324,0.002 0.358,-0.019L0.329,-0.145C0.312,-0.138 0.297,-0.135 0.28,-0.135C0.251,-0.135 0.24,-0.156 0.24,-0.186L0.24,-0.7L0.058,-0.7L0.058,-0.161C0.058,-0.047 0.111,0.012 0.216,0.012Z"
                style="fill-rule:nonzero;"/>
        </g>
        <g transform="matrix(125.644,0,0,125.644,659.858,178.072)">
            <path
                d="M0.549,-0.27C0.549,-0.42 0.442,-0.505 0.301,-0.505C0.171,-0.505 0.029,-0.426 0.029,-0.245C0.029,-0.066 0.16,0.011 0.311,0.011C0.394,0.011 0.468,-0.016 0.518,-0.062L0.444,-0.165C0.41,-0.139 0.371,-0.124 0.321,-0.124C0.28,-0.124 0.224,-0.147 0.213,-0.199L0.541,-0.199C0.547,-0.223 0.549,-0.248 0.549,-0.27ZM0.297,-0.375C0.34,-0.375 0.382,-0.349 0.376,-0.29L0.211,-0.29C0.214,-0.348 0.253,-0.375 0.297,-0.375Z"
                style="fill-rule:nonzero;"/>
        </g>
        <g transform="matrix(125.644,0,0,125.644,731.852,178.072)">
            <path
                d="M0.573,-0.7L0.016,-0.7L0.016,-0.645L0.265,-0.645L0.265,-0L0.324,-0L0.324,-0.645L0.573,-0.645L0.573,-0.7Z"
                style="fill-rule:nonzero;"/>
        </g>
        <g transform="matrix(125.644,0,0,125.644,792.036,178.072)">
            <path
                d="M0.529,-0.265C0.529,-0.417 0.435,-0.504 0.294,-0.504C0.151,-0.504 0.049,-0.396 0.049,-0.247C0.049,-0.096 0.15,0.01 0.296,0.01C0.37,0.01 0.449,-0.018 0.502,-0.072L0.471,-0.111C0.425,-0.066 0.356,-0.042 0.297,-0.042C0.19,-0.042 0.114,-0.114 0.106,-0.226L0.527,-0.226C0.528,-0.24 0.529,-0.253 0.529,-0.265ZM0.293,-0.452C0.404,-0.452 0.473,-0.388 0.475,-0.275L0.106,-0.275C0.118,-0.383 0.192,-0.452 0.293,-0.452Z"
                style="fill-rule:nonzero;"/>
        </g>
        <g transform="matrix(125.644,0,0,125.644,863.527,178.072)">
            <path
                d="M0.252,-0.501C0.194,-0.501 0.138,-0.488 0.076,-0.46L0.093,-0.413C0.142,-0.435 0.2,-0.45 0.25,-0.45C0.357,-0.45 0.424,-0.407 0.424,-0.313L0.424,-0.265C0.363,-0.296 0.304,-0.308 0.241,-0.308C0.126,-0.308 0.04,-0.251 0.04,-0.149C0.04,-0.049 0.123,0.009 0.23,0.009C0.32,0.009 0.397,-0.038 0.429,-0.108L0.431,-0.108C0.429,-0.073 0.429,-0.038 0.429,-0L0.481,-0L0.481,-0.313C0.481,-0.442 0.39,-0.501 0.252,-0.501ZM0.237,-0.042C0.159,-0.042 0.097,-0.082 0.097,-0.15C0.097,-0.219 0.159,-0.259 0.247,-0.259C0.305,-0.259 0.377,-0.242 0.426,-0.214C0.42,-0.11 0.337,-0.042 0.237,-0.042Z"
                style="fill-rule:nonzero;"/>
        </g>
        <g transform="matrix(125.644,0,0,125.644,933.888,178.072)">
            <path
                d="M0.305,0.01C0.371,0.01 0.433,-0.012 0.482,-0.054L0.454,-0.098C0.409,-0.06 0.356,-0.043 0.305,-0.043C0.197,-0.043 0.106,-0.118 0.106,-0.247C0.106,-0.377 0.197,-0.451 0.305,-0.451C0.354,-0.451 0.405,-0.434 0.446,-0.399L0.477,-0.442C0.429,-0.482 0.371,-0.504 0.306,-0.504C0.162,-0.504 0.049,-0.405 0.049,-0.247C0.049,-0.09 0.163,0.01 0.305,0.01Z"
                style="fill-rule:nonzero;"/>
        </g>
        <g transform="matrix(125.644,0,0,125.644,999.223,178.072)">
            <path
                d="M0.086,-0L0.143,-0L0.143,-0.271C0.143,-0.371 0.217,-0.449 0.322,-0.449C0.426,-0.449 0.481,-0.387 0.481,-0.28L0.481,-0L0.538,-0L0.538,-0.284C0.538,-0.422 0.463,-0.501 0.33,-0.501C0.242,-0.501 0.169,-0.453 0.141,-0.393L0.139,-0.393C0.142,-0.426 0.143,-0.471 0.143,-0.516L0.143,-0.7L0.086,-0.7L0.086,-0Z"
                style="fill-rule:nonzero;"/>
        </g>
        <g transform="matrix(125.644,0,0,125.644,1076.75,178.072)">
            <path
                d="M0.114,-0.601C0.141,-0.601 0.159,-0.62 0.159,-0.646C0.159,-0.671 0.141,-0.69 0.114,-0.69C0.088,-0.69 0.069,-0.671 0.069,-0.646C0.069,-0.62 0.088,-0.601 0.114,-0.601ZM0.086,-0L0.143,-0L0.143,-0.494L0.086,-0.494L0.086,-0Z"
                style="fill-rule:nonzero;"/>
        </g>
        <g transform="matrix(125.644,0,0,125.644,1105.52,178.072)">
            <path
                d="M0.086,-0L0.143,-0L0.143,-0.271C0.143,-0.371 0.217,-0.449 0.322,-0.449C0.426,-0.449 0.481,-0.387 0.481,-0.28L0.481,-0L0.538,-0L0.538,-0.284C0.538,-0.422 0.463,-0.501 0.33,-0.501C0.241,-0.501 0.169,-0.457 0.14,-0.391L0.138,-0.391C0.14,-0.428 0.14,-0.461 0.14,-0.494L0.086,-0.494L0.086,-0Z"
                style="fill-rule:nonzero;"/>
        </g>
        <g transform="matrix(125.644,0,0,125.644,1183.04,178.072)">
            <path
                d="M0.313,0.25C0.461,0.25 0.553,0.159 0.553,0.011L0.553,-0.494L0.498,-0.494C0.498,-0.438 0.498,-0.418 0.5,-0.38L0.498,-0.38C0.473,-0.451 0.393,-0.503 0.296,-0.503C0.152,-0.503 0.049,-0.397 0.049,-0.247C0.049,-0.098 0.152,0.007 0.297,0.007C0.392,0.007 0.472,-0.043 0.497,-0.111L0.499,-0.111C0.497,-0.071 0.496,-0.044 0.495,0.021C0.494,0.129 0.424,0.197 0.312,0.197C0.241,0.197 0.182,0.182 0.11,0.147L0.088,0.195C0.155,0.232 0.232,0.25 0.313,0.25ZM0.303,-0.046C0.188,-0.046 0.106,-0.129 0.106,-0.248C0.106,-0.367 0.186,-0.45 0.301,-0.45C0.417,-0.45 0.496,-0.369 0.496,-0.249C0.496,-0.126 0.42,-0.046 0.303,-0.046Z"
                style="fill-rule:nonzero;"/>
        </g>
    </g>
                            <g transform="matrix(1,0,0,1,-211.614,-178.072)">
                                <g transform="matrix(0.836124,6.15741e-17,-9.22742e-17,-0.499529,34.6784,401.981)">
                                    <rect x="211.614" y="268.072" width="35.88" height="60.057"/>
                                </g>
                                <g transform="matrix(0.836124,2.07526e-17,-3.10995e-17,-0.999057,74.6784,535.89)">
                                    <rect x="211.614" y="268.072" width="35.88" height="60.057"/>
                                </g>
                                <g transform="matrix(0.836124,-2.0069e-17,3.00751e-17,-1.49859,114.678,669.8)">
                                    <rect x="211.614" y="268.072" width="35.88" height="60.057"/>
                                </g>
                            </g>
</svg>
                    </a>
                </div>
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
            <div class="flex flex-col mt-4 space-y-2 lg:mt-0 lg:flex-row lg:space-x-16 lg:space-y-0">
                <a class="text-gray-700 dark:text-gray-200 dark:hover:text-lime-green-400 hover:text-lime-green-500"
                   href="{{ route('courses.index') }}">Courses</a>
            </div>
            @auth
                <a class="block px-5 py-2 mt-4 font-medium leading-5 text-center text-white hover:text-white capitalize bg-lime-green-500 rounded-lg lg:mt-0 hover:bg-lime-green-400 lg:w-auto"
                   href="{{ route('dashboard') }}">
                    Dashboard
                </a>
            @else
                Login
            @endauth
        </nav>

        <div class="py-10 md:py-40">
            <div class="container px-6 py-16 mx-auto text-center bg-gray-100 rounded-xl shadow-lg bg-blob "
                 style="background-position: 50% 60%; background-size: cover;">
                <div class="max-w-lg mx-auto">
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-white md:text-4xl">Assignment Tracking</h1>
                    <p class="mt-6 text-gray-500 dark:text-gray-300 mb-4">This page keeps track of your assignments and
                        tells you instantly when an assignment has been passed.</p>
                    <a href="{{ route('courses.index') }}"
                       class="px-6 py-2 mt-6 text-sm font-medium leading-5 text-center text-white capitalize bg-lime-green-400 rounded-lg hover:bg-lime-green-300 md:mx-0 md:w-auto focus:outline-none shadow-lg">
                        Get Started Now
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-white dark:bg-gray-800">
        <div class="container px-6 py-8 mx-auto">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-8 w-8 text-lime-green-600 dark:text-lime-green-500 stroke-current" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>

                    <h1 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">Assignments and Projects</h1>

                    <p class="mt-2 text-gray-500 dark:text-gray-400">In total, <b
                            class="text-lime-green-400">{{ $assignmentCount  }}</b> assignments have been created with
                        an associated <b class="text-lime-green-400">{{ $projectCount }}</b> projects.</p>
                </div>

                <div>
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-8 w-8 text-lime-green-600 dark:text-lime-green-500 stroke-current" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>

                    <h1 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">{{ $buildCount }} Builds</h1>

                    <p class="mt-2 text-gray-500 dark:text-gray-400">During the last month <b
                            class="text-lime-green-400">{{ $buildCount }}</b> builds have run, with an averge run time
                        of <b class="text-lime-green-400">{{ number_format($buildAvg, 2) }}</b> seconds</p>
                </div>

                <div>
                    <svg class="h-8 w-8 text-lime-green-600 dark:text-lime-green-500 stroke-current"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>

                    <h1 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">Average Queue Time</h1>

                    <p class="mt-2 text-gray-500 dark:text-gray-400">Over the last month the average queue time has been
                        <b class="text-lime-green-400">{{ number_format($avgQueue, 2) }}</b> seconds</p>
                </div>
            </div>
        </div>
    </section>
@endsection
