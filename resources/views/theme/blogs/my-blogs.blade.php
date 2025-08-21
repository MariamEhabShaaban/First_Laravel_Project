@extends('theme.master')
@section('title', 'My Blogs')

@section('content')

    @include('theme.partials.hero')
    <section class="section-margin--small section-margin">
        <div class="container">
            @if (session('BlogDeleteStatus'))
                <div class="alert alert-success">
                    {{ session('BlogDeleteStatus') }}
                </div>
            @endif
            <div class="row">

                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" width="5%">#</th>
                                <th scope="col">Blog Title</th>
                                <th scope="col" width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($blogs) > 0)
                                @foreach ($blogs as $blog)
                                    <tr>
                                        <th scope="row">#</th>
                                        <td><a href="{{ route('blogs.show', ['blog' => $blog]) }}">{{ $blog->name }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('blogs.edit', ['blog' => $blog]) }}"
                                                class="btn btn-sm btn-primary mr-2">Edit</a>
                                            <form action="{{ route('blogs.destroy', ['blog' => $blog]) }}" method="post"
                                                id="delete" class="d-inline">
                                                @csrf
                                                @method('delete')

                                                <a href="javascript:$('form#delete').submit();"
                                                    class="btn btn-sm btn-danger mr-2">Delete</a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach


                            @endif

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>


@endsection
