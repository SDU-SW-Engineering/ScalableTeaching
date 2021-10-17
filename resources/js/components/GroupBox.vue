<template>
    <div class="border-2 rounded-xl p-4 border-lime-green-400 relative">
        <h3 class="absolute text-lime-green-400 -my-8 -ml-2 bg-white dark:bg-gray-800 px-2"><slot name="title"></slot></h3>
        <p class="text-gray-600 dark:text-gray-100"><slot></slot></p>
    </div>
</template>
