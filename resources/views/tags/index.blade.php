@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
    <a href="/tags/create" class="btn btn-success"> Add tag </a>
</div>
<div class="card card-default">
    <div class="card-header">tags</div>
    <div class="card-body">
        @if($tags->count() > 0)
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Posts Counts </th>
                <th></th>

            </thead>
            <tbody>
                @foreach($tags as $tag)
                <tr>
                    <td> {{ $tag -> name}} </td>
                    <td> {{ $tag -> posts-> count()}} </td>
                    @if(auth()->user()->isAdmin())
                    <td> <a href="{{ route('tags.edit', $tag->id)}}" class="btn btn-info btn-sm"> Edit </a>
                        <button class="btn btn-sm btn-danger" onclick="handleDelete({{ $tag->id }})">Delete</button>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="" method="POST" id="deletetagForm">
                    @method('delete')
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete tag</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">Are you sure you want to delete this tag?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                            <button type="submit" class="btn btn-danger">Yes, Delete.</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @else
        <h3 class="text-center">No tags Yet</h3>
        @endif
    </div>
</div>

@endsection

@section('scripts')
<script>
    function handleDelete(id) {

        var form = document.getElementById('deletetagForm');
        form.action = '/tags/' + id;
        $('#deleteModal').modal('show')
    }
</script>

@endsection