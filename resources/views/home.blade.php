@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

            <form action="{{route('message-admin')}}" method="post">

                    {{csrf_field()}}

                <textarea name="message" class="form-control">
                    
                </textarea>

                <input type="submit" class="form-control" value="send message">
            </form>




                            </div>
            </div>
        </div>
    </div>
</div>
@endsection
