<!-- 
    Name: Vera Korchemnaya
    Description: Show Page
        - Shows the detail of the selected comic book
        - Implements the Spectre card component
        - Uses layout
 -->

@extends('issues.layout')

@section('content')

<h3>Comic Book Details</h3>
<div class="container">
    <div class="columns">
        <div class="column col-4" style="padding: 0.4rem;">
            <div class="card">
                <div class="card-image">
                    <img src="{{url('/images/cover.png')}}" alt="Comic Book Cover" class="img-responsive">
                </div>
                <div class="card-header">
                    <div class="card-title h4">
                        {{$comic->title}}
                    </div>
                </div>
                <div class="card-body">
                    <!-- This php is to convert from how month and condition are stored in the database (as integers) to
                         how the user will be seeing the data on the page (as strings)  -->
                    @php
                    $months = array('DEC', 'NOV', 'OCT', 'SEP', 'AUG', 'JUL', 'JUN', 'MAY', 'APR', 'MAR', 'FEB', 'JAN');
                    $conditions = array('PO', 'FA', 'GD', 'VG', 'FN', 'VF', 'NM', 'MT');
                    @endphp

                    Volume: {{$comic->volume}}
                    Issue Number: {{$comic->issue_number}}
                    <br>
                    Publication Date: {{$months[$comic->month - 1]}} {{$comic->year}}
                    <br>
                    Condition: {{$conditions[$comic->condition - 1]}}
                    <br>
                    Writer: {{$comic->writer_last_name}} {{$comic->writer_first_name}}
                    <br>
                    Artist: {{$comic->artist_last_name}}
                    {{$comic->artist_first_name}}

                </div>
            </div>
        </div>
    </div>
    <!-- Back button. Goes to index page. -->
    <a class="btn btn-primary" href="{{route('issues.index')}}">Back</a>
</div>

@endsection