@extends('starter')
@section('title', 'Create Question')

@section('header')
   <div style="padding: 20px; font-size: 25px; margin:10px " > Ask Public Question</div>
@endsection
@section('questions')
<form action="{{route('questions.store')}} " method="POST">
    @csrf
    @include('questions/_form-question',[
        'btn' => 'ADD Question'
    ])

</form>
@endsection
@section('script')
    <script src="{{asset("assets/admin/posts/form/main.js")}}"></script>
@endsection