<div class="form-group">
    <label for="{{$name}}">{{$label}}</label>
    <small style="display: block">{{$cabtion}}</small>
    <input type="{{$type ?? 'text'}}" class="form-control @error($name)
    is-invalid
    @enderror" name="{{$name}}" value="{{old($name, $value)}}"  placeholder="{{$placeholder}}"/>
    <p class="invalid-feedback">@error($name) {{$message}} @enderror</p>
</div>