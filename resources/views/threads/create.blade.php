@extends('layouts.app')

@section ('head')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Créer une nouvelle Rubrique</div>

                    <div class="panel-body">
                        <form method="POST" action="/threads">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="channel_id">Choisir un Canal:</label>
                                <select name="channel_id" id="channel_id" class="form-control" required>
                                    <option value="">Choisir un...</option>

                                    @foreach ($channels as $channel)
                                        <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                                            {{ $channel->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">Titre:</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{ old('title') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="body">Corps:</label>
                                <wysiwyg name="body" value="{{ old('body') }}"></wysiwyg>
                            </div>

                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="{{ config('services..key') }}"></div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Publier</button>
                            </div>

                            @if (count($errors))
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
