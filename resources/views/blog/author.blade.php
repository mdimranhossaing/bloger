@extends('layout.app')
@section('stylesheet')
<style>
    .about-author .thumbnail img {
        width: 100px;
    }
</style>
@endsection
@section('content')




    <!-- Start Author Area  -->
    <div class="axil-author-area axil-author-banner bg-color-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-author">
                        <div class="media">
                            <div class="thumbnail">
                                <a href="{{route('blog.user', $user->username)}}">
                                    <img src="{{asset('upload/'. $user->photo)}}" alt="Author Images">
                                </a>
                            </div>
                            <div class="media-body">
                                <div class="author-info">
                                    <h1 class="title"><a href="{{route('blog.user', $user->username)}}">{{$user->name}}</a></h1>
                                    <span class="b3 subtitle">Sr. UX Designer</span>
                                </div>
                                <div class="content">
                                    <p class="b1 description">At 40+ years old, my favorite compliment is being told that I
                                        look like my mom. Seeing myself in her image, like this daughter up top, makes me so
                                        proud of how far I’ve come, and so thankful for where I come from</p>
                                    <ul class="social-share-transparent size-md">
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="far fa-envelope"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Author Area  -->

    <!-- Start Post List Wrapper  -->
    <div class="axil-post-list-area axil-section-gap bg-color-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title">
                        <h2 class="title mb--40">Articles By {{$user->name}}</h2>
                    </div>
                </div>
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
                                                    <a class="hover-flip-item-wrapper"
                                                        href="{{route('blog.user', $post->user->username)}}">
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
