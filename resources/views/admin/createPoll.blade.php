@extends('base')

@section('title', $poll->title)

@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        {{--        <div>--}}
        {{--            <label for="image">Image</label>--}}
        {{--            <input type="file" class="form-control" id="image">--}}
        {{--            @error("image") {{ $message }} @enderror--}}
        {{--        </div>--}}
        <div>
            <label for="title">Titre</label>
            <input type="text" name="title" value= {{ old('title', $poll->title) }}>
            @error("title") {{ $message }} @enderror
            @error("slug") {{ $message }} @enderror
        </div>
        <div>
            <label for="context">Contexte</label>
            <textarea name="context" id="context">{{ old('context', $poll->context) }}</textarea>
            @error("context") {{ $message }} @enderror
        </div>
        <div>
            <label for="quote">Citation</label>
            <textarea name="quote" id="quote">{{ old('quote', $poll->quote) }}</textarea>
            @error("quote") {{ $message }} @enderror
        </div>
        <div>
            <label for="author">Auteur</label>
            <textarea name="author" id="author">{{ old('quote', $poll->author) }}</textarea>
            @error("author") {{ $message }} @enderror
        </div>
        <div>
            <label for="analysis">Analyse</label>
            <textarea name="analysis" id="analysis">{{ old('analysis', $poll->analysis) }}</textarea>
            @error("analysis") {{ $message }} @enderror
        </div>
        <div>
            <label for="published_at">Sélectionnez une date :</label>
            <input type="date" id="published_at" name="published_at" required>
            @error("published_at") {{ $message }} @enderror
        </div>
        <div>
            <label for="is_intox">Intox</label>
            <input type="checkbox" id="is_intox" name="is_intox" value="0" required>
            @error("is_intox") {{ $message }} @enderror
        </div>
        <button>
            @if($poll->id)
                Save
            @else
                Create
            @endif
        </button>
    </form>
@endsection
