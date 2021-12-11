<label for="{{$name}}">{{$label}}</label>
<small style="display: block">{{$cabtion??''}}</small>
 <textarea name="{{$name}}" name="{{$name}}" placeholder="{{$placeholder ?? ''}}" class="form-control @error($name)
   is-invalid   @enderror" cols="30" rows="10">{{old($name, $value ?? null)}}</textarea>
 <p class="invalid-feedback">@error($name) {{$message}}  @enderror</p>