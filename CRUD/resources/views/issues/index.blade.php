<!-- 
    Name: Vera Korchemnaya
    Description: Main Listing Page
        - This page displays all the comic books
          in a table. Used Spectre CSS for styling.
        - Most columns are clickable links that sort the records in ascending or 
          descending order based on the column selected.
        - Used layout
 -->

@extends('issues.layout')

@section('content')
<h3>All Comic Books</h3>

<!-- Button to create a comic -->
<a class="btn btn-primary" href="{{route('issues.create')}}">Add Comic</a>

<!-- Following line for pagination. There are 25 records per page -->
{!! $comicIssues->appends(\Request::except('page'))->render() !!}
<table class="table table-striped table-hover">
    <tr>
        <th><a href="{{route('issues.index', 'field=title&sort=asc')}}">Title</a></th>
        <th>Volume</th>
        <th><a href="{{route('issues.index', 'field=issue_number&sort=asc')}}">Issue Number</a></th>
        <th><a href="{{route('issues.index', 'field=date&sort=desc')}}">Publication Date</a></th>
        <th><a href="{{route('issues.index', 'field=condition&sort=desc')}}">Condition</a></th>
        <th><a href="{{route('issues.index', 'field=writer_last_name&sort=asc')}}">Writer</a></th>
        <th><a href="{{route('issues.index', 'field=artist_last_name&sort=asc')}}">Artist</a></th>
        <th>Details</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    @foreach ($comicIssues as $issue)
    <tr>
        <!-- This php is to convert from how month and condition are stored in the database (as integers) to
             how the user will be seeing the data on the page (as strings)  -->
        @php
        $months = array('DEC', 'NOV', 'OCT', 'SEP', 'AUG', 'JUL', 'JUN', 'MAY', 'APR', 'MAR', 'FEB', 'JAN');
        $conditions = array('PO', 'FA', 'GD', 'VG', 'FN', 'VF', 'NM', 'MT');
        @endphp
        <td>{{$issue->title}}</td>
        <td>{{$issue->volume}}</td>
        <td>{{$issue->issue_number}}</td>
        <td>{{$months[$issue->month - 1]}} {{$issue->year}}</td>
        <td>{{$conditions[$issue->condition - 1]}}</td>
        <td>{{$issue->writer_last_name}}</td>
        <td>{{$issue->artist_last_name}}</td>
        <td><a href="{{route('issues.show', $issue->id)}}"><i class="icon icon-search"></i></a></td>
        <td><a href="{{route('issues.edit', $issue->id)}}"><i class="icon icon-edit"></i></a></td>

        <!-- This is to delete a record -->
        <td>
            <form action="{{route('issues.destroy', $issue->id)}}" method="POST" onSubmit="return confirm ('Are you sure you want to delete {{$issue->title}} ?');">
                @csrf
                @method("DELETE")

                <button class="btn btn-error" type="submit">Delete</button>
            </form>
        </td>

    </tr>
    @endforeach
</table>

<!-- Pagination is also on the bottom of the page -->
{!! $comicIssues->appends(\Request::except('page'))->render() !!}

@endsection