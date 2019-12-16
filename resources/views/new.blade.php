@extends('listtable')

@section('dialog')
    @component('components.dialog')
        @slot('action')
            {{ url('add?col=' . $column . '&asc=' . $asc . '&page=' . $page . '&where=' . $where) }}
        @endslot
        @slot('title')
            New Student
        @endslot
        @slot('no')
            {{ $nextnumber}}
        @endslot
        @slot('name')
        @endslot
        @slot('surname')
        @endslot
        @slot('department')
        @endslot
        @slot('button')
            Add
        @endslot

    @endcomponent

@endsection