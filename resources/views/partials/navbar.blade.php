<nav class="bg-white shadow dark:bg-gray-800 relative z-10">
    <div class="container px-6 py-4 mx-auto md:flex md:justify-between md:items-center" v-scope="{ show: true }">
        <div class="flex items-center justify-between">
            <div>
                <a class="text-2xl font-bold text-gray-800 dark:text-white lg:text-3xl hover:text-gray-700 dark:hover:text-gray-300" href="{{ route('home') }}">WebTech</a>
            </div>

            <!-- Mobile menu button -->
            <div class="flex md:hidden">
                <button @click="show = !show" type="button" class="text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400" aria-label="toggle menu">
                    <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                        <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
        <div class="items-center md:flex" :class="{'hidden': show}">
            <div class="flex flex-col md:flex-row items-center">
                <a class="my-1 text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-indigo-500 dark:hover:text-indigo-400 md:mx-4 md:my-0" href="#">Courses</a>
                <a class="my-1 text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-indigo-500 dark:hover:text-indigo-400 md:mx-4 md:my-0" href="#">Assignments</a>
                <a class="my-1 text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-indigo-500 dark:hover:text-indigo-400 md:mx-4 md:my-0" href="#">Groups</a>
                <a class="my-1 text-sm py-1 px-2 font-medium bg-lime-green-500 rounded hover:bg-lime-green-400 text-white hover:text-white md:ml-4 md:my-0" href="#">{{ auth()->user()->getAuthIdentifierName() }}</a>
            </div>

        </div>
    </div>
</nav>
