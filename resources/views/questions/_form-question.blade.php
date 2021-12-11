{{-- {{dd($tags)}} --}}
    <div class="form-control">
        <div class="form-group">
            <x-form-input label="Title" cabtion="Be specific and imagine you’re asking a question to another person"
            name="title" :value="$question->title" placeholder="e.g Is there an R function for finding the index" />
        </div>
        <div class="form-group">
            <x-form-textarea  name="body" label="Body" :Value="$question->body"   cabtion="Include all the information someone would need to answer your question"/>
        </div>
        {{-- <div class="form-group">
            <x-form-input name="tags" label="Tags" cabtion="Add up to 5 tags to describe what your question is about"
            :value="$question->tags" placeholder="e.g I(pyahton , php , ... )" />
        </div> --}}
        <div class="form-group">
            <x-form-datalist label='Tags' input-name='tags' datalist-name='tags' :colloection='$tags' />         
        </div>
        
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{$btn}} </button>
    </div>
