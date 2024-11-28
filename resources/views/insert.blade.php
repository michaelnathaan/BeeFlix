@extends('main')
@section('content')


@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<form id="movieForm" method="POST" action="{{ url('insertMovie') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
    @csrf
        <div class="mb-3">
        <label for="genre" class="form-label">Genre</label>
        <select class="form-select" id="genre" name="genre" required>
        <option value="" disabled selected>Select a genre</option>
        @foreach($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
        @endforeach
    </select>
        <div class="invalid-feedback">Please select a genre.</div>
        </div>
        
        <div class="mb-3">
        <label for="photo" class="form-label">Photo</label>
        <input type="file" class="form-control" id="photo" name="photo" placeholder="No file chosen" required>
        <div class="invalid-feedback">This field is required.</div>    
        </div>

        <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="" required>
        <div class="invalid-feedback">This field is required.</div>    
        </div>

        <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control"  id="description" name="description" rows="3" required></textarea>
        <div class="invalid-feedback">This field is required.</div>
        </div>

        <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Publish Date</label>
        <input type="date" class="form-control" id="publish_date" name="publish_date" placeholder="mm/dd/yyyy" required>
        <div class="invalid-feedback">The release date cannot be in the future.</div>
        </div>

        
        <button class="btn btn-dark mx-3">submit</button>

        <a class="btn btn-dark mx-3" href="/">back to homepage</a>
</form>

<script>
        (function () {
            'use strict';
            const form = document.querySelector('#movieForm');
            const releaseDateInput = document.querySelector('#publish_date');
            const photoInput = document.querySelector('#photo');
            const descriptionInput = document.getElementById('description');
            const titleInput = document.getElementById('title');

            form.addEventListener('submit', function (event) {
                let isValid = form.checkValidity();

                // title max 30
                if (titleInput.value.length > 30) {
                    isValid = false;
                    titleInput.classList.add('is-invalid');
                    titleInput.nextElementSibling.textContent = "Title cannot exceed 30 characters.";
                } else {
                    titleInput.classList.remove('is-invalid');
                }

                //desc max 50
                if (descriptionInput.value.length > 50) {
                    isValid = false;
                    descriptionInput.classList.add('is-invalid');
                    descriptionInput.nextElementSibling.textContent = "Description cannot exceed 50 characters.";
                } else {
                    descriptionInput.classList.remove('is-invalid');
                }
                
                //date validation
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                const todayFormatted = today.toISOString().split('T')[0];

                console.log(todayFormatted, releaseDateInput.value);
                if (!releaseDateInput.value) {
                    isValid = false;
                    releaseDateInput.classList.add('is-invalid');
                    releaseDateInput.nextElementSibling.textContent = "The release date is required.";
                } else {
                    
                    const releaseDate = new Date(releaseDateInput.value);
                    releaseDate.setHours(0, 0, 0, 0); 

                    if (releaseDate > today) {
                        isValid = false;
                        releaseDateInput.classList.add('is-invalid');
                        releaseDateInput.nextElementSibling.textContent = "The release date cannot be in the future.";
                    } else {
                        releaseDateInput.classList.remove('is-invalid');
                    }
                }

                
                // file validation
                const file = photoInput.files[0];
                if (file) {
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    if (!allowedTypes.includes(file.type)) {
                        isValid = false;
                        photoInput.classList.add('is-invalid');
                        photoInput.nextElementSibling.textContent = "Please upload a valid image file (JPEG, PNG, or GIF).";
                    }
                    else if (file.size > 5 * 1024 * 1024) { // 5MB
                        isValid = false;
                        photoInput.classList.add('is-invalid');
                        photoInput.nextElementSibling.textContent = "File size must be below 5MB.";
                    } 
                    else {
                        photoInput.classList.remove('is-invalid');
                    }
                } else {
                    //no file is selected
                    photoInput.classList.add('is-invalid');
                    photoInput.nextElementSibling.textContent = "Please upload a valid image file.";
                    isValid = false;
                }

                //field validation
                if (!isValid) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        })();
    </script>


@endsection