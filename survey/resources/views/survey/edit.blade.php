@extends('layouts.app-master')

@section('content')
    <form action="{{ route('survey.update', $survey['id']) }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <br>
        <div class="col-3">
            <div class="mb-3">
                <label for="subject" class="form-label">Question</label>
                <input type="text" class="form-control" id="subject" name="subject"
                       value="{{ $survey['subject'] ?? null }}">
            </div>
            @foreach($options as $key => $option)
                <div class="mb-3">
                    <label for="first-answer" class="form-label">Answer</label>
                    <input type="text" class="form-control" id="first-answer" name="answer[]"
                           value="{{ $option['name'] ?? null}}">
                    <label for="first-count" class="form-label">How many people responded by choosing this
                        option</label>
                    <input type="text" class="form-control" id="first-status" name="count[]"
                           value="{{ $option['count_votes'] ?? null }}">
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>
@endsection
