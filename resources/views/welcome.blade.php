@extends('layouts.blog')

@section('title')
    Saas Blog
@endsection

@section('header')
    <!--header -->
    <header class="header text-center text-white" style="background-image: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);">
        <div class="container">

            <div class="row">
                <div class="col-md-8 mx-auto">

                    <h1>Latest Blog Posts</h1>
                    <p class="lead-2 opacity-90 mt-6">Read and get updated on how we progress</p>

                </div>
            </div>

        </div>
    </header><!-- /.header -->
@endsection

@section('content')
    <!-- Main Content -->
    <main class="main-content">
        <div class="section bg-gray">
            <div class="container">
                <div class="row">


                    <div class="col-md-8 col-xl-9">
                        <div class="row gap-y">
                            @forelse ($posts as $post)
                                <div class="col-md-6">
                                    <div class="card border hover-shadow-6 mb-6 d-block">
                                        <a href="{{route('blog.show', $post->id)}}"><img class="card-img-top" src="{{asset('storage/'. $post->image)}}" alt="Card image cap"></a>
                                        <div class="p-6 text-center">
                                            <p><a class="small-5 text-lighter text-uppercase ls-2 fw-400" href="#">{{$post->category->name}}</a></p>
                                            <h5 class="mb-0"><a class="text-dark" href="{{route('blog.show', $post->id)}}">{{$post->name}}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center">
                                    No results found for the query <strong> {{request()->query('search')}} </strong>
                                </p>
                            @endforelse

                        </div>

                        {{-- Pagination will be injected in vendor in resources folder wich copied from [php artisan vendor:publish] then choose laravel-pagination
                        and we will inject this pagination to simple-bootstrap-4.blade.php file wich contain simplepaginate method --}}
                        {{-- <nav class="flexbox mt-30">
                            <a class="btn btn-white disabled"><i class="ti-arrow-left fs-9 mr-4"></i> Newer</a>
                            <a class="btn btn-white" href="#">Older <i class="ti-arrow-right fs-9 ml-4"></i></a>
                        </nav> --}}
                        {{$posts->appends(['search' => request()->query('search')])->links()}} {{--appends used to keep search through pagination --}}
                    </div>



                    @include('partial.sidebar')

                </div>
            </div>
        </div>
    </main><!-- /.Main Content -->
@endsection


