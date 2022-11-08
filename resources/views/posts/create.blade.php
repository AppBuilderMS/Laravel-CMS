@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card card-default">
        <div class="card-header">
            @if(isset($post))
                    Edit Post
            @else
                Create Post
            @endif

        </div>
        <div class="card-body">
            <form action="{{isset($post) ? route('posts.update', $post->id) : route('posts.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                @if(isset($post))
                    @method('PATCH')
                @endif

                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" id="name" class="form-control" name="name" value="{{isset($post) ? $post->name : ''}}">
                </div>

                <div class="form-group mt-2">
                    <label for="description">Description</label>
                    <textarea id="description" class="form-control" name="description" cols="5" rows="5">{{isset($post) ? $post->description : ''}}</textarea>
                </div>

                <div class="form-group mt-2">
                    <label for="content">Content</label>
                    <input id="content" type="hidden" name="content" value="{{isset($post) ? $post->content : ''}}"> {{--https://github.com/basecamp/trix--}}
                    <trix-editor class="trix-content" input="content"></trix-editor> {{--https://github.com/basecamp/trix--}}
                </div>

                <div class="form-group mt-2">
                    <label for="published_at">Published At</label>
                </div>
                <input type="text" id="published_at" class="form-control " name="published_at" value="{{isset($post) ? $post->published_at : ''}}">

                <div class="form-group mt-2">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}"
                                @if(isset($post))
                                    @if($category->id == $post->category_id)
                                        selected
                                    @endif
                                @endif
                            >
                                {{$category->name}}
                            </option>
                        @endforeach
                    </select>
                </div>

                @if(isset($post))
                    <div class="form-group mt-2">
                        <img src="{{asset('storage/' . $post->image)}}" alt="" style="width:100%">
                    </div>
                @endif

                <div class="form-group mt-2">
                    <label for="image">image</label>
                    <input type="file" id="image" class="form-control" name="image">
                </div>

                @if($tags->count() > 0)
                    <div class="form-group mt-2">
                        <label for="tags">Tags</label>
                        <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                            @foreach ($tags as $tag)
                                <option value="{{$tag->id}}"
                                    @if(isset($post))
                                        @if($post->hasTag($tag->id))
                                            selected
                                        @endif
                                    @endif
                                    >
                                    {{$tag->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-success">
                        {{isset($post) ? 'Update Post' : 'Create Post'}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" defer></script> {{--https://cdnjs.com/libraries/trix--}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> {{--https://flatpickr.js.org/getting-started/--}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> {{--https://select2.org/getting-started/installation--}}
    <script>
/*         flatpickr("#published_at", {
            enableTime : true,
            enableSeconds: true
        }) */
        $(document).ready(function() {
            $("#published_at").flatpickr({
                static : true,
                // enableTime : true,
                // enableSeconds: true
             });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.tags-selector').select2();
        });
    </script> {{--https://select2.org/getting-started/basic-usage--}}

@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css"> {{--https://cdnjs.com/libraries/trix--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> {{--https://flatpickr.js.org/getting-started/--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> {{--https://select2.org/getting-started/installation--}}
    <style>
        .flatpickr-wrapper {
            position: relative;
            display: block !important;
        }
    </style>
@endsection
