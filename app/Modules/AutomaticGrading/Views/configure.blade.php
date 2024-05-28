@php use App\Modules\AutomaticGrading\AutomaticGradingType; @endphp
<div class="lg:w-1/2  w-full">
    <div class="mb-4">
        <h2 class="text-lime-green-400 mb-1 font-semibold">Select type of automatic grading</h2>
        <automatic-grading-configuration
            :grading-types="{{ json_encode(array_map(function ($case) {return ["name" => $case->name, "value" => $case->value];}, AutomaticGradingType::cases())) }}"
            :current-grading-type="{{ json_encode($gradingType) }}"
        ></automatic-grading-configuration>
    </div>
</div>
