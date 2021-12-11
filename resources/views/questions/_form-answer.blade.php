
    <div class="form-control">   
        <div class="form-group">
            {{-- <input type="text" hidden name="question_id" value="{{GET()}}" > --}}
            <x-form-textarea  name="body" label="Your Answer" placeholder='Write Your Answer'/>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{$btn}} </button>
    </div>
