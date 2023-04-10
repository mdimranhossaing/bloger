@extends('layout.app')
@section('content')



    <!-- Start Breadcrumb Area  -->
    <div class="axil-breadcrumb-area breadcrumb-style-1 bg-color-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner">
                        <h1 class="page-title">{{ $category->name }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->
    <!-- Start Post List Wrapper  -->
    <div class="axil-post-list-area axil-section-gap bg-color-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-8">

                    @if (count($posts) > 0)
                        @foreach ($posts as $post)
                            <!-- Start Post List  -->
                            <div class="content-block post-list-view mt--30">
                                <div class="post-thumbnail">
                                    <a href="post-details.html">
                                        <img src="{{ asset('upload/' . $post->thumbnail) }}" alt="Post Images">
                                    </a>
                                </div>
                                <div class="post-content">
                                    <div class="post-cat">
                                        <div class="post-cat-list">
                                            <a class="hover-flip-item-wrapper"
                                                href="{{ route('blog.category', $post->category->slug) }}">
                                                <span class="hover-flip-item">
                                                    <span
                                                        data-text="{{ $post->category->name }}">{{ $post->category->name }}</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                    <h4 class="title"><a
                                            href="{{ route('blog.single', $post->slug) }}">{{ $post->title }}</a></h4>
                                    <div class="post-meta-wrapper">
                                        <div class="post-meta">
                                            <div class="content">
                                                <h6 class="post-author-name">
                                                    <a class="hover-flip-item-wrapper" href="{{route('blog.user', $post->user->username)}}">
                                                        <span class="hover-flip-item">
                                                            <span
                                                                data-text="{{ $post->user->name }}">{{ $post->user->name }}</span>
                                                        </span>
                                                    </a>
                                                </h6>
                                                <ul class="post-meta-list">
                                                    <li>{{ date('M d, Y', strtotime($post->created_at)) }}</li>
                                                    <li>{{ $post->views }} {{ $post->views == 1 ? 'view' : 'views' }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <ul class="social-share-transparent justify-content-end">
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fas fa-link"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- End Post List  -->
                        @endforeach
                    @endif

                    {{-- Pagination --}}
                    <div class="mt-5">{{ $posts->links('vendor.pagination.bootstrap-5') }}</div>

                </div>
                <div class="col-lg-4 col-xl-4 mt_md--40 mt_sm--40">
                    @include('blog.sidebar')
                </div>
            </div>
        </div>
    </div>
    <!-- End Post List Wrapper  -->

@endsection
