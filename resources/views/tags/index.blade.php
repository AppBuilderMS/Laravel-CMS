@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('tags.create')}}" class="btn btn-success">Create tag</a>
    </div>
    <div class="card card-default">
        <div class="card-header">tags</div>
        <div class="card-body">
            @if($tags->count() > 0)
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Post Count</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>
                                    {{$tag->name}}
                                </td>
                                <td>{{$tag->posts->count()}}</td>
                                <td>
                                    <a href="{{route('tags.edit', $tag->id)}}" class="btn btn-info btn-sm">Edit</a>
                                    <button class="btn btn-danger btn-sm" onclick="handleDelete({{$tag->id}})">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Delete Modal From Bootstrap -->
                <form action="" method="POST" id="deleteTagForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete tag</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center font-weight-bold">Are you sure you want to delete {{$tag->name}} tag ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
                                <button type="submit" class="btn btn-danger">Yes, Delete</button> <!--Must be Submit-->
                            </div>
                        </div>
                        </div>
                    </div>
                </form>

            @else
                <h3 class="text-center">No Tags Yet</h3>
            @endif

        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        function handleDelete(id) {
            var form = document.getElementById('deleteTagForm')
            form.action = '/tags/' + id
            console.log('deleteing' , form)
            $('#deleteModal').modal('show')
        }
    </script>
@endsection
