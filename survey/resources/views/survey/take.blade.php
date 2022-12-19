@extends('layouts.app-master')

@section('content')
    <div class="row col-5">
        <h4 class="fw-bold text-center mt-3"></h4>
        <form class="bg-white px-4" action="{{ route('home.index') }}" method="get">
            <p class="fw-bold">{{ $survey->subject }}</p>
            @foreach($options as $option)
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="answer" id="answer"/>
                    <label class="form-check-label" for="answer">
                        {{ $option->name }}
                    </label>
                </div>
            @endforeach
            <div class="col-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
