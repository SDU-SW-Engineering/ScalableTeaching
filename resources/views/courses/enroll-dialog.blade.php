@extends('master')

@section('content')
    <div class="px-6 pt-4 lg:max-w-xl container mx-auto">
        <x-confirm header="" sub-header="" accept-route="lol" :decline-route="null">
            lol
        </x-confirm>
    </div>
@endsection
