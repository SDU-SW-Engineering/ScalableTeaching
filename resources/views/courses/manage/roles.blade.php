@extends('courses.manage.master')

@section('manageContent')
    <section class="pt-4">
        <h1 class="text-3xl font-semibold">Roles</h1>
        <div class="flex flex-col shadow-md mt-4 rounded-lg border">
            @foreach($course->roles as $role)
                <div class="flex items-center bg-white first:rounded-t-lg last:rounded-b-lg hover:bg-gray-50 py-4 border-b px-3 last:border-0">
                    <span class="w-1/2">{{ $role->name }}</span>
                    @if($role->default)
                        <span class="text-sm font-semibold text-lime-green-500">Default</span>
                    @endif
                </div>
            @endforeach
        </div>
    </section>
@endsection
