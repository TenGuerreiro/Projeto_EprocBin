@extends($template)

@section('content')

    @foreach([
        'multiAutocomplete',
        'table',
        'preventXSS',
        'requiredFields',
        'fileUpload',
        'fileUploadSubmit',
        'multipleSelect',
        ] as $page)
        @include('includer', ['page'=>'components.'.$page])
    @endforeach

@endsection
