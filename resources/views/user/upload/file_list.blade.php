<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

@if (Route::has('login'))
<div class="top-right links" style="width:100%">
    @auth
    <a href="{{ url('/home') }}">Home</a>
    @else
    <a href="{{ route('List Files') }}">File List</a> |
    <a href="{{ route('Upload File') }}">Upload File</a>|
    <a href="/">Home</a>

    @endauth
</div>
@endif
<table class="table" id="table">
    <thead>
        <tr>
            <th class="text-center">Id</th>
            <th class="text-center">Title</th>
            <th class="text-center">Action</th>

        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr class="item{{$item->id}}">
            <td>{{$item->id}}</td>
            <td>{{$item->title}}</td>

            <td>
                <button class="delete-modal btn btn-danger" data-id="{{$item->id}}">
                    <span class="glyphicon glyphicon-trash"></span> Delete
                </button></td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });

    $(document).on('click', '.delete-modal', function() {
        var id=$(this).attr("data-id");
        $.ajax({
            type: 'post',
            url: '{{ route('Delete File') }}',
            data: {
                "_token": "{{ csrf_token() }}",
                'id': $(this).attr("data-id")
            },
            success: function(data) {
                
                $('.item'+id).remove();
                alert("deleted successfully");
            }
        });
    });
</script>