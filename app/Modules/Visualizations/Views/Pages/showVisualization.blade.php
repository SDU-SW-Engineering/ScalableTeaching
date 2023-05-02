<iframe id="shinyFrame"
        style="height: 100%; width: 100%"
        title="IFrame for shiny"
        src="http://localhost:3838">
</iframe>
<script>
    async function testFetch() {
        const url = 'http://localhost:8080/courses/{{ $course->id }}/tasks/{{ $task->id }}/admin/modules/Visualizations/presence/{{ $visualizationServer->id }}'
        setInterval(async () => {
            let response = await fetch(url);
            console.log(response.status)
        }, 5000)
    }

    window.addEventListener('load', testFetch, false)

</script>
