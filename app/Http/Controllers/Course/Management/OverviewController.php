<?php

namespace App\Http\Controllers\Course\Management;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Domain\Analytics\Graph\DataSets\BarDataSet;
use Domain\Analytics\Graph\DataSets\LineDataSet;
use Domain\Analytics\Graph\Graph;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class OverviewController extends Controller
{
    public function index(Course $course): View
    {
        /** @var Collection<string,int> $exerciseEngagement */
        $exerciseEngagement = $course->exercise_engagement;
        $userEngagementGraph = $exerciseEngagement == null ? null : new Graph(
            $exerciseEngagement->keys(),
            new BarDataSet("Engagement %", $exerciseEngagement->values(), "#4F535B"),
        );


        /** @var Collection<string,int> $enrolmentPerDay */
        $enrolmentPerDay = $course->enrolment_per_day;
        $enrolmentPerDayGraph = new Graph(
            $enrolmentPerDay->keys(),
            new LineDataSet("Enrolled in total", $enrolmentPerDay->values(), "#266ab0", true)
        );

        return view('courses.manage.index', [
            'course'              => $course,
            'userEngagementGraph' => $userEngagementGraph,
            'enrolmentGraph'      => $enrolmentPerDayGraph,
        ]);
    }
}
