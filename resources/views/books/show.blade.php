
@extends('layouts.app')
   

<style>
    .fa {
      font-size: 40px !important;
      cursor: pointer;
      user-select: none;
    }
    
    .fa-thumbs-up:hover {
      color: green;
    }

    .fa-heart:hover{
      color: orange;
    }
</style>
@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show book</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('books.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-10">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    {{ $book->name }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Author Name:</strong>
                                    {{ $book->author_name }}
                                </div>
                            </div>
                        </div>
                        <div class="col-1" style="padding:10px">
                            <form>
                                @csrf
                                <input type="hidden" name="book_id" id="book_id" value="{{ $book->id }}" />
                                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}" />
                                @if(count($like) > 0)
                                <i class="fa fa-thumbs-up" title="Liked" style="color: green"></i>
                                <strong><span>{{count($likeCount)}}</span></strong>
                                @else
                                <i onclick="likeFunction()" class="fa fa-thumbs-up" title="Like"></i>
                                <strong><span>{{count($likeCount)}}</span></strong>
                                @endif
                            </form>
                        </div>
                        <div class="col-1" style="padding:10px">
                            @if(count($favorite) > 0)
                            <i onclick="removefavorite({{ $book->id }})" class="fa fa-heart" style="color:orange;" title="Favorited"></i>
                            <strong><span>{{count($favoriteCount)}}</span></strong>
                            @else
                            <i onclick="favoriteFunction({{ $book->id }})" class="fa fa-heart" title="Add Favorite"></i>
                            <strong><span>{{count($favoriteCount)}}</span></strong>
                            @endif

                        </div>
                    </div>

                    <hr />
                    <h4>Display Comments</h4>
  
                    @include('books.commentsDisplay', ['comments' => $book->comments, 'book_id' => $book->id])
   
                    <hr />

                    <h4>Add comment</h4>
                    <form method="post" action="{{ route('comments.store'   ) }}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="comment"></textarea>
                            <input type="hidden" name="book_id" value="{{ $book->id }}" />
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Add Comment" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection