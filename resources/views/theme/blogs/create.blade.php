@extends('theme.master')
@section('title', 'Add Blog')

@section('content')

    @include('theme.partials.hero')
    <section class="section-margin--small section-margin">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('blogs.store') }}" class="form-contact contact_form" enctype="multipart/form-data"
                        method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control border" name="name" type="text"
                                        placeholder="Enter blog title" value="{{ old('name') }}">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <select class="form-control border" name="category_id">
                                        <option value="">Select Blog Category</option>
                                        @if (count($categories) > 0)
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach

                                        @endif

                                    </select>
                                    <x-input-error :messages="$errors->get('')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control different-control w-100" name="description" cols="30" rows="5"
                                        placeholder="Enter Description"></textarea>
                                    </textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />

                                </div>

                                <div class="form-group">
                                    <input class="form-control border" name="image" type="file">
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>


                                <div class="form-group text-center text-md-right mt-3">

                                    <button type="submit" class="button button--active button-contactForm">ADD</button>
                                </div>
                            </div>
                    </form>

                </div>
            </div>
        </div>
    </section>


@endsection
