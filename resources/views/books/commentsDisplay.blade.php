@foreach($comments as $comment)
    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
        <strong>{{ $comment->user->name }}</strong>
        <p>{{ $comment->comment }}</p>
        <a href="" id="reply"></a>
        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="comment" class="form-control" />
                <input type="hidden" name="book_id" value="{{ $book_id }}" />
                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-warning" value="Reply" />
            </div>
        </form>
        @include('books.commentsDisplay', ['comments' => $comment->replies])
    </div>
@endforeach  
