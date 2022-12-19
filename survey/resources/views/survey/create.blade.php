@extends('layouts.app-master')

@section('content')
<form action="{{ route('survey.create') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <br>
    <div class="col-3 div-container" id="div-container">
        <div class="mb-3">
            <label for="subject" class="form-label">Question</label>
            <input type="text" class="form-control" id="subject" name="subject">
        </div>
        <div class="mb-3">
            <label for="first-answer" class="form-label">Answer</label>
            <input type="text" class="form-control" id="first-answer" name="answer[1]">
            <label for="first-count" class="form-label">How many people responded by choosing this option</label>
            <input type="text" class="form-control" id="first-status" name="count[1]">
        </div>
        <div class="mb-3">
            <label for="second-answer" class="form-label">Answer</label>
            <input type="text" class="form-control" id="second-answer" name="answer[2]">
            <label for="second-count" class="form-label">How many people responded by choosing this option</label>
            <input type="text" class="form-control" id="second-count" name="count[2]">

        </div>
        <div class="mb-3">
            <label for="third-answer" class="form-label">Answer</label>
            <input type="text" class="form-control" id="third-answer" name="answer[3]">
            <label for="third-count" class="form-label">How many people responded by choosing this option</label>
            <input type="text" class="form-control" id="third-count" name="count[3]">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>
@endsection
