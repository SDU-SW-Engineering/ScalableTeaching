<x-sidebar-group name="Feedback">
<x-sidebar-item name="Delegate" route="courses.tasks.admin.gradingDelegate"
                :route-params="[$course, $task]">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
         stroke="currentColor" class="w-5 h-5 text-gray-400">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
    </svg>
</x-sidebar-item>
<x-sidebar-item name="Feedback Moderation" route="courses.tasks.admin.feedback.moderation"
                :route-params="[$course, $task]">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current text-gray-400 h-5 w-5"
         style="transform: ;msFilter:;">
        <path d="M11 6h2v5h-2zm0 6h2v2h-2z"></path>
        <path
            d="M20 2H4c-1.103 0-2 .897-2 2v18l5.333-4H20c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zm0 14H6.667L4 18V4h16v12z"></path>
    </svg>
</x-sidebar-item>
</x-sidebar-group>
