<div class="card mt-4 ">
    <div class="text-light-blue card-header ">Jawaban Anda </div>
    <div class="card-body">
        <form action="/jawaban" method="POST">
            @csrf
            <input type="hidden" name="question_id" value="{{$question->id}}">
            <div class="form-group">
                {{-- <label for="content">Jawaban</label> --}}
                <textarea name="content" class="form-control" id="content" cols="5" rows="5"></textarea>
            </div>

            <button type="submit" class="btn btn-success mt-2">Submit</button>
        </form>
    </div>
</div>