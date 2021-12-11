
{{-- {{dd($notifications)}} --}}
<style>a:hover {
    text-decoration: none;
 }</style>
<div class="notfication">
    <div class="">
        <h5><i class="far fa-comment-alt"></i> Notification</h5>
        <ul id="not" >
           @if ($notifications)
                @foreach ($notifications as $notify)
                <a style="" href="{{$notify->data['url']}}"><li >{{$notify->data['body']}}</a></li>
                @endforeach
           @endif
        </ul>
    </div>
</div>