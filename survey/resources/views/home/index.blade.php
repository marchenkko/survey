@extends('layouts.app-master')

@section('content')
    @auth
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <p class="margin-bottom-20"></p>
        <div class="container">
            <form method="get" action="{{ route('home.index') }}">
                <div class="row">
                    <div class="col">
                        <select class="form-select" aria-label="Sort" name="sort" id="sort">
                            <option value="created_at">Date</option>
                            <option value="subject">Subject</option>
                            <option value="status">Status</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <div class="text-nowrap bd-highlight">
                            Sort
                        </div>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Subject</th>
                <th scope="col">Go Survey</th>
            </tr>
            </thead>
            <tbody>

            @foreach($data as $survey)
                @if($survey['status'] == 1)
                    <tr>
                        <th scope="row">{{ $survey['id']}}</th>
                        <td>{{ $survey['subject'] }}</td>
                        <td><a href="{{ $survey['link'] }}">Go</a></td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
        {{ $pagination->links() }}
    @endauth

    @guest
        <div class="bg-light p-5 rounded">
            <h1>Homepage</h1>
            <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        </div>
    @endguest

@endsection
