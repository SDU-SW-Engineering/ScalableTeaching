<template>
    <div>
        <div class="fixed opacity-50 h-full w-full bg-black">

        </div>
        <div style="position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%, -50%);
    color: white;
    z-index: 1000;">
            <div class="flex py-4 px-5 border-lime-green-300 border-2">
                <svg class="animate-spin mr-3 h-8 w-8 text-lime-green-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <div>
                    <h2 class="text-lg text-lime-green-300 -mb-2 font-medium -mt-1.5">Loading files...</h2>
                    <span class="text-sm text-lime-green-500">Please hang on</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {}
</script>
