@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <a href="/questionnaires/create" class="btn btn-dark">Create new Questionnaire</a>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">My questionnaires</div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($questionnaires as $questionnaire)
                                <li class="list-group-item ">
                                    <a href="{{ $questionnaire->path() }}">{{ $questionnaire->title}}</a>

                                    <div class="mt-2">
                                        <small>Shared URL</small>
                                        <p>
                                            <a href="{{ $questionnaire->publicPath() }}">{{ $questionnaire->publicPath() }}</a>
                                        </p>

                                    </div>
                                </li>
                                <div class="card-footer">
                                    <form action="/questionnaires/{{ $questionnaire->id}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this question?')">DELETE</button>
                                    </form>
                                </div>
                            @endforeach
                        </ul>
                    </div>

            </div>
        </div>
    </div>
</div>
@endsection
