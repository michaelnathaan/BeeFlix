@extends('main')
@section('content')

<div class="image-container">
    <img src={{asset('storage/img/main.jpg')}} alt="asdas" class="responsive-image">
    <div class="d-flex justify-content-center">
        <a class="btn btn-dark text-white btn-block" type="button" href="{{url('insert/')}}">add new movie</a>
    </div>
</div>

<div class="card-container row d-flex flex-wrap justify-content-center px-2 mt-4 gap-3">


    @foreach ($movies as $mv)
        <div class="card" style="width: 18rem;">
            <img src="{{ asset('storage/' . $mv->photo) }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title fw-bold">{{$mv->title}}</h5>
                <p class="fw-bold">{{$mv->Genre->name}}</p>
                <p class="card-text">{{$mv->description}}</p>
                <p class="text-muted">{{$mv->publish_date}}</p>

                <form action="{{ url('deleteMovie/' . $mv->id) }}" method="POST" id="deleteForm{{ $mv->id }}">

                    <div class="d-flex justify-content-center">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $mv->id }})">Delete</button>
                    </div>
                </form>


            </div>
        </div>
    @endforeach

</div>

<br>

<div class="d-flex justify-content-between align-items-center">

    <div class="text-left px-6">
        Showing {{ $movies->firstItem() }} to {{ $movies->lastItem() }} of {{ $movies->total() }} results
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination px-6">

            @if ($movies->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">&laquo;</a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $movies->previousPageUrl() }}" tabindex="-1">&laquo;</a>
                </li>
            @endif


            @foreach ($movies->links()->elements[0] as $page => $url)
                @if ($page == $movies->currentPage())
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">{{ $page }}</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach


            @if ($movies->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $movies->nextPageUrl() }}">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-disabled="true">&raquo;</a>
                </li>
            @endif
        </ul>
    </nav>
</div>

<!-- delete prompt -->
<script>
    function confirmDelete(movieId) {

        var confirmAction = confirm('Are you sure you want to delete this movie?');
        if (confirmAction) {
            // Get the form with the correct ID for the movie
            var form = document.getElementById('deleteForm' + movieId);

            // Log for debugging
            console.log('Submitting form for movie ID: ' + movieId);
            console.log('Form action URL: ' + form.action); // Ensure the correct URL is used

            // Submit the form
            form.submit();
        } else {
            return false;
        }
    }
</script>
@endsection