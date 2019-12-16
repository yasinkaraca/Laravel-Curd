@extends('listtable')

@section('dialog')
    @component('components.dialog')
        @slot('action')
            {{ url('update?col=' . $column . '&asc=' . $asc . '&page=' . $page . '&where=' . $where, ['no' => $student->no]) }}
        @endslot
        @slot('title')
            Update Student
        @endslot
        @slot('no')
            {{ $student->no }}
        @endslot
        @slot('name')
            {{ $student->name }}
        @endslot
        @slot('surname')
            {{ $student->surname }}
        @endslot
        @slot('department')
            {{ $student->department}}
        @endslot
        @slot('button')
            Save
        @endslot

    @endcomponent
@endsection
