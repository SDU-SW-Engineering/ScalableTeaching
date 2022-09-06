<?php

namespace App\Http\Controllers\Task\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Task;
use Illuminate\Support\Facades\Http;

class SettingsController extends Controller
{
    public function preferences(Course $course, Task $task)
    {
        return view('tasks.admin.preferences');
    }

    public function saveDescription()
    {
        echo Http::post('http://localhost:8188/md',['text' => "# hello
```java
class Student
{
    int id;//data member (also instance variable)
    String name; //data member (also instance variable)

    public static void main(String args[])
    {
        Student s1=new Student();//creating an object of Student
        System.out.println(s1.id);
        System.out.println(s1.name);
     }
}
```"])->json('html');
    }
}
