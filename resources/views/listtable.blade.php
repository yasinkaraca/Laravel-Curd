@extends('layouts.app')

@section('content')
<div class="row m-md-2 m-lg-2 mr-md-4 mr-lg-4">
    <div class="ml-auto">
        <a class="btn btn-success" href="newForm?col={{ $column }}&asc={{ $asc }}&page={{ $page }}&where={{ $where }}">New Student</a>
    </div>
</div>
<table id="studentList" class="table table-striped" style="margin-top:5px;">
    <thead class='thead-dark'>
    <tr>
        <th id="hNo" style="border: 0px;border-radius: 25px;" onClick="arrange(this.id, 'no', '{{ $column }}', '{{ $asc }}', '{{ $page }}', '{{ $where }}')">Student Number</th>
        <th id="hName" style="border: 0px;border-radius: 25px;" onClick="arrange(this.id, 'name', '{{ $column }}', '{{ $asc }}', '{{ $page }}', '{{ $where }}')">Name</th>
        <th id="hSurname" style="border: 0px;border-radius: 25px;" onClick="arrange(this.id, 'surname', '{{ $column }}', '{{ $asc }}', '{{ $page }}', '{{ $where }}')">Surname</th>
        <th id="hDepartment" style="border: 0px;border-radius: 25px;" onClick="arrange(this.id, 'department', '{{ $column }}', '{{ $asc }}', '{{ $page }}', '{{ $where }}')">Department</th>
    </tr>
    </thead>
    <tbody>	
        
        <tr style='background: rgba(150, 255, 150, .3)'>
            <td><input id='findNo' type='text'/></td>
            <td><input id='findName' type='text' /></td>
            <td><input id='findSurname' type='text' /></td>
            <td><input id='findDepartment' type='text' /></td>
            <td><button type='button' class='btn btn-primary' onClick='wipe()'>Clear</button></td>
            <td><button type='button' class='btn btn-primary' onClick='findStudent()'>Find</button></td>
        </tr>
        @foreach ($students as $student)
            <tr>
                <td>{{$student->no}}</td>
                <td>{{$student->name}}</td>
                <td>{{$student->surname}}</td>
                <td>{{$student->department}}</td>
                <td><a class="btn btn-primary" href="{{ url('form?col=' . $column . '&asc=' . $asc . '&page=' . $page . '&where=' . $where, ['no' => $student->no]) }}">Update</a></td>
                <td><a class="btn btn-primary" href="{{ route('deleteStudent', ['no' => $student->no]) }}">Delete</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="center">
    {{ $students->links('pagination::bootstrap-4') }}
</div>
<div>
    @yield('dialog')
</div>
<script>
    var updown = ("{{ $asc }}" == "asc")? "&nbsp;&nbsp;&nbsp;&nbsp;&#x25b2;" : "&nbsp;&nbsp;&nbsp;&nbsp;&#x25bc;";

    header = document.getElementById("h" + "{{ $column }}"[0].toUpperCase() + "{{ $column }}".slice(1));
    header.innerHTML += updown;
    header.style.color = "#8888ff";
    console.log(header.innerHTML);
</script>
@endsection
