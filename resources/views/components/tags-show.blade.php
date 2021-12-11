@foreach ($tags as $tag)

    <a href="{{route('questions.tagged', ['name' => $tag->slug])}}"> {{$tag->name}} </a>
@endforeach
