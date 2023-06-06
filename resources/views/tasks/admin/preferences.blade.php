@extends('tasks.admin.master')

@section('adminContent')
    <admin-preferences :task="{{ $task }}" starts-at="{{ $startsAt }}" ends-at="{{ $endsAt }}"></admin-preferences>
@endsection

@section('scripts')
    <script type="text/javascript" defer>
        let config = {
            mask: 'hh:mm',
            lazy: false,
            blocks: {
                hh: {
                    mask: IMask.MaskedRange,
                    from: 0,
                    to: 23
                },
                mm: {
                    mask: IMask.MaskedRange,
                    from: 0,
                    to: 59
                }
            },
        };
        window.IMask(document.getElementById('start-time'), config)
        window.IMask(document.getElementById('end-time'), config)
    </script>
@endsection

