@extends('tasks.admin.master')

@section('adminContent')
    <div class="bg-white dark:bg-gray-600 shadow p-4 rounded-lg grid grid-cols-1">
        <visitors-list :students="{{ $students }}"></visitors-list>
    </div>
@endsection
