<label style="margin-bottom: 10px">{{$label}}</label>
<input type="text" name = '{{$inputName}}' list="{{$datalistName}}" multiple="multiple" />     
<datalist id="{{$datalistName}}">
    @foreach ($colloection as $item)   
        <option >{{$item}}</option>
    @endforeach
</datalist>   