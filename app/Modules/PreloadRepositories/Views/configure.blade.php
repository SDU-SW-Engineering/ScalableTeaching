<div class="w-full">
    <div class="w-1/2">
        <div class="mb-4">
            <h2 class="text-lime-green-400 mb-1 font-semibold">Availability</h2>
            <input type="number" name="availability" class="bg-gray-500 text-white w-full rounded-md" value="{{ old('availability', $availability) }}" max="100" min="0" step="1">
            <p class="text-sm text-gray-300 mt-1">% of repositories to create ahead of time, based on students enrolled in the course. Preloading will start 6 hours ahead of start-time.</p>
        </div>
    </div>
</div>
