<!-- 
    Name: Vera Korchemnaya
    Description: Create a comic book
        - Includes an external form.
        - Is sent to issues.store route where it is validated.
        - Used layout
 -->
@extends('issues.layout')

@section('content')

<h3>Create a Comic Book</h3>

<!-- 
    Display any errors found by store method in IssueController
 -->
@if ($errors->any())
<div class="toast toast-error">
    @foreach ($errors->all() as $error)
    <span>{{$error}}</span><br>
    @endforeach
</div>
@endif

<!-- Form -->
<div class="column col-6 col-sm-12">

    <form class="form-horizontal" method="POST" action="{{route('issues.store')}}">
        @csrf

        @include('issues.form')
        <!-- SUBMIT -->
        <button type="submit" class="btn btn-primary">Store Comic</button>
        <a href="{{route('issues.index', $comic->id)}}">Cancel</a>

    </form>

</div>
@endsection