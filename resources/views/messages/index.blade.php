@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Messages</div>
                    <div class="panel-body">
                        <ul>
                            @foreach($messages['data'] as $message)
                                <li>
                                    <span class="font-weight-bold">{{ $message['sender']['name'] }}</span>
                                    <br/>
                                    <a href="">{{ $message['body'] }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <a href="{{ $messages['prev_page_url']}}">Previous</a>
                        <a href="{{ $messages['next_page_url']}}">Next</a>
                        <span>Total: {{ $messages['total'] }} </span>

                        <form method="POST" action="{{ route('conversations.messages.store', ['form' => $conversation['id']]) }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="description">Message:</label>
                                <textarea class="form-control" id="message" name="message" placeholder="Write something down..."></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Send</button>
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