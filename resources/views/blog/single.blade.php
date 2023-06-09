@extends('layout.app')
@section('stylesheet')
    <style>
        .banner-single-post.post-formate .content-block .post-thumbnail {
            position: relative;
        }

        .banner-single-post.post-formate .content-block .post-thumbnail img {
            border-radius: 0 0 10px 10px;
            width: 100%;
        }

        .banner-single-post.post-formate .content-block .post-thumbnail .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(000, 000, 000, 0.5);
            background-image: url()
        }

        .post-meta .post-author-avatar img {
            width: 50px;
        }

        .about-author .thumbnail a img {
            width: 100px;
        }
    </style>
@endsection
@section('content')
    <!-- Start Banner Area -->
    <div class="banner banner-single-post post-formate post-standard alignwide">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Start Single Slide  -->
                    <div class="content-block">
                        <!-- Start Post Thumbnail  -->
                        <div class="post-thumbnail">
                            <img class="img-fulid" src="{{ asset('upload/' . $post->thumbnail) }}" alt="Post Images">
                            <div class="overlay"></div>
                        </div>
                        <!-- End Post Thumbnail  -->
                        <!-- Start Post Content  -->
                        <div class="post-content">
                            <div class="post-cat">
                                <div class="post-cat-list">
                                    <a class="hover-flip-item-wrapper" href="{{route('blog.category', $post->category->slug)}}">
                                        <span class="hover-flip-item">
                                            <span data-text="{{$post->category->name}}">{{$post->category->name}}</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <h1 class="title">{{ $post->title }}</h1>
                            <!-- Post Meta  -->
                            <div class="post-meta-wrapper">
                                <div class="post-meta">
                                    <div class="post-author-avatar border-rounded">
                                        <img src="{{ asset('upload/' . $post->user->photo) }}" alt="Author Images">
                                    </div>
                                    <div class="content">
                                        <h6 class="post-author-name">
                                            <a class="hover-flip-item-wrapper" href="{{route('blog.user',$post->user->username)}}">
                                                <span class="hover-flip-item">
                                                    <span data-text="{{ $post->user->name }}">{{ $post->user->name }}</span>
                                                </span>
                                            </a>
                                        </h6>
                                        <ul class="post-meta-list">
                                            <li>{{ date('M d, Y', strtotime($post->created_at)) }}</li>
                                            <li>{{ $post->views }} {{ $post->views == 1 ? 'view' : 'views' }}</li>
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
                        <!-- End Post Content  -->
                    </div>
                    <!-- End Single Slide  -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Banner Area -->

    <!-- Start Post Single Wrapper  -->
    <div class="post-single-wrapper axil-section-gap bg-color-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="axil-post-details">
                        <p>{{ $post->content }}</p>

                        <div class="tagcloud">

                            @if (count($tags) > 0)
                                @foreach ($tags as $tag)
                                    @if (in_array($tag->id, $post->getTagIdArray()))
                                        <a href="#">{{ $tag->name }}</a>
                                    @endif
                                @endforeach
                            @endif
                        </div>

                        <div class="social-share-block">
                            <div class="post-like">
                                <a href="#"><i class="fal fa-thumbs-up"></i><span>{{ $post->like }}
                                        {{ $post->like == 1 ? 'Like' : 'Likes' }}</span></a>
                            </div>
                            <ul class="social-icon icon-rounded-transparent md-size">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>

                        <!-- Start Author  -->
                        <div class="about-author">
                            <div class="media">
                                <div class="thumbnail">
                                    <a href="#">
                                        <img src="{{ asset('upload/' . $post->user->photo) }}" alt="Author Images">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="author-info">
                                        <h5 class="title">
                                            <a class="hover-flip-item-wrapper" href="#">
                                                <span class="hover-flip-item">
                                                    <span
                                                        data-text="{{ $post->user->name }}">{{ $post->user->name }}</span>
                                                </span>
                                            </a>
                                        </h5>
                                        <span class="b3 subtitle">Sr. UX Designer</span>
                                    </div>
                                    <div class="content">
                                        <p class="b1 description">At 29 years old, my favorite compliment is being
                                            told that I look like my mom. Seeing myself in her image, like this
                                            daughter up top, makes me so proud of how far I’ve come, and so thankful
                                            for where I come from.</p>
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
                        <!-- End Author  -->

                        <!-- Start Comment Form Area  -->
                        <div class="axil-comment-area">
                            <div class="axil-total-comment-post">
                                <div class="title">
                                    <h4 class="mb--0">30+ Comments</h4>
                                </div>
                                <div class="add-comment-button cerchio">
                                    <a class="axil-button button-rounded" href="post-details.html" tabindex="0"><span>Add
                                            Your Comment</span></a>
                                </div>
                            </div>

                            <!-- Start Comment Respond  -->
                            <div class="comment-respond">
                                <h4 class="title">Post a comment</h4>
                                <form action="#">
                                    <p class="comment-notes"><span id="email-notes">Your email address will not be
                                            published.</span> Required fields are marked <span class="required">*</span>
                                    </p>
                                    <div class="row row--10">
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <div class="form-group">
                                                <label>Your Name</label>
                                                <input id="name" type="text">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <div class="form-group">
                                                <label>Your Email</label>
                                                <input id="email" type="email">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <div class="form-group">
                                                <label>Your Website</label>
                                                <input id="website" type="text">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Leave a Reply</label>
                                                <textarea name="message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <p class="comment-form-cookies-consent">
                                                <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent"
                                                    type="checkbox" value="yes">
                                                <label for="wp-comment-cookies-consent">Save my name, email, and
                                                    website in this browser for the next time I comment.</label>
                                            </p>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-submit cerchio">
                                                <input name="submit" type="submit" id="submit"
                                                    class="axil-button button-rounded" value="Post Comment">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- End Comment Respond  -->

                            <!-- Start Comment Area  -->
                            <div class="axil-comment-area">
                                <h4 class="title">2 comments</h4>
                                <ul class="comment-list">
                                    <!-- Start Single Comment  -->
                                    <li class="comment">
                                        <div class="comment-body">
                                            <div class="single-comment">
                                                <div class="comment-img">
                                                    <img src="/assets/images/post-images/author/author-b2.png"
                                                        alt="Author Images">
                                                </div>
                                                <div class="comment-inner">
                                                    <h6 class="commenter">
                                                        <a class="hover-flip-item-wrapper" href="#">
                                                            <span class="hover-flip-item">
                                                                <span data-text="Cameron Williamson">Cameron
                                                                    Williamson</span>
                                                            </span>
                                                        </a>
                                                    </h6>
                                                    <div class="comment-meta">
                                                        <div class="time-spent">Nov 23, 2018 at 12:23 pm</div>
                                                        <div class="reply-edit">
                                                            <div class="reply">
                                                                <a class="comment-reply-link hover-flip-item-wrapper"
                                                                    href="#">
                                                                    <span class="hover-flip-item">
                                                                        <span data-text="Reply">Reply</span>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="comment-text">
                                                        <p class="b2">Duis hendrerit velit scelerisque felis tempus, id
                                                            porta
                                                            libero venenatis. Nulla facilisi. Phasellus viverra
                                                            magna commodo dui lacinia tempus. Donec malesuada nunc
                                                            non dui posuere, fringilla vestibulum urna mollis.
                                                            Integer condimentum ac sapien quis maximus. </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="children">
                                            <!-- Start Single Comment  -->
                                            <li class="comment">
                                                <div class="comment-body">
                                                    <div class="single-comment">
                                                        <div class="comment-img">
                                                            <img src="/assets/images/post-images/author/author-b3.png"
                                                                alt="Author Images">
                                                        </div>
                                                        <div class="comment-inner">
                                                            <h6 class="commenter">
                                                                <a class="hover-flip-item-wrapper" href="#">
                                                                    <span class="hover-flip-item">
                                                                        <span data-text="Rahabi Khan">Rahabi Khan</span>
                                                                    </span>
                                                                </a>
                                                            </h6>
                                                            <div class="comment-meta">
                                                                <div class="time-spent">Nov 23, 2018 at 12:23 pm
                                                                </div>
                                                                <div class="reply-edit">
                                                                    <div class="reply">
                                                                        <a class="comment-reply-link hover-flip-item-wrapper"
                                                                            href="#">
                                                                            <span class="hover-flip-item">
                                                                                <span data-text="Reply">Reply</span>
                                                                            </span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="comment-text">
                                                                <p class="b2">Pellentesque habitant morbi tristique
                                                                    senectus et netus et malesuada fames ac turpis egestas.
                                                                    Suspendisse lobortis cursus lacinia. Vestibulum vitae
                                                                    leo id diam pellentesque ornare.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- End Single Comment  -->
                                        </ul>
                                    </li>
                                    <!-- End Single Comment  -->

                                    <!-- Start Single Comment  -->
                                    <li class="comment">
                                        <div class="comment-body">
                                            <div class="single-comment">
                                                <div class="comment-img">
                                                    <img src="/assets/images/post-images/author/author-b2.png"
                                                        alt="Author Images">
                                                </div>
                                                <div class="comment-inner">
                                                    <h6 class="commenter">
                                                        <a class="hover-flip-item-wrapper" href="#">
                                                            <span class="hover-flip-item">
                                                                <span data-text="Rahabi Khan">Rahabi Khan</span>
                                                            </span>
                                                        </a>
                                                    </h6>
                                                    <div class="comment-meta">
                                                        <div class="time-spent">Nov 23, 2018 at 12:23 pm</div>
                                                        <div class="reply-edit">
                                                            <div class="reply">
                                                                <a class="comment-reply-link hover-flip-item-wrapper"
                                                                    href="#">
                                                                    <span class="hover-flip-item">
                                                                        <span data-text="Reply">Reply</span>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="comment-text">
                                                        <p class="b2">Duis hendrerit velit scelerisque felis tempus, id
                                                            porta
                                                            libero venenatis. Nulla facilisi. Phasellus viverra
                                                            magna commodo dui lacinia tempus. Donec malesuada nunc
                                                            non dui posuere, fringilla vestibulum urna mollis.
                                                            Integer condimentum ac sapien quis maximus. </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- End Single Comment  -->
                                </ul>
                            </div>
                            <!-- End Comment Area  -->

                        </div>
                        <!-- End Comment Form Area  -->


                    </div>
                </div>
                <div class="col-lg-4">
                    @include('blog.sidebar')
                </div>
            </div>
        </div>
    </div>
    <!-- End Post Single Wrapper  -->

    <!-- Start More Stories Area  -->
    <div class="axil-more-stories-area axil-section-gap bg-color-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2 class="title">More Stories</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                <!-- Start Stories Post  -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <!-- Start Post List  -->
                    <div class="post-stories content-block mt--30">
                        <div class="post-thumbnail">
                            <a href="post-details.html">
                                <img src="/assets/images/post-single/stories-01.jpg" alt="Post Images">
                            </a>
                        </div>
                        <div class="post-content">
                            <div class="post-cat">
                                <div class="post-cat-list">
                                    <a href="#">LEADERSHIP</a>
                                </div>
                            </div>
                            <h5 class="title"><a href="post-details.html">Microsoft and Bridgestone launch real-time
                                    tire</a></h5>
                        </div>
                    </div>
                    <!-- End Post List  -->
                </div>
                <!-- Start Stories Post  -->

                <!-- Start Stories Post  -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <!-- Start Post List  -->
                    <div class="post-stories content-block mt--30">
                        <div class="post-thumbnail">
                            <a href="post-details.html">
                                <img src="/assets/images/post-single/stories-02.jpg" alt="Post Images">
                            </a>
                        </div>
                        <div class="post-content">
                            <div class="post-cat">
                                <div class="post-cat-list">
                                    <a href="#">DESIGN</a>
                                </div>
                            </div>
                            <h5 class="title"><a href="post-details.html">Microsoft and Bridgestone launch real-time
                                    tire</a></h5>
                        </div>
                    </div>
                    <!-- End Post List  -->
                </div>
                <!-- Start Stories Post  -->

                <!-- Start Stories Post  -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <!-- Start Post List  -->
                    <div class="post-stories content-block mt--30">
                        <div class="post-thumbnail">
                            <a href="post-details.html">
                                <img src="/assets/images/post-single/stories-03.jpg" alt="Post Images">
                            </a>
                        </div>
                        <div class="post-content">
                            <div class="post-cat">
                                <div class="post-cat-list">
                                    <a href="#">PRODUCT UPDATES</a>
                                </div>
                            </div>
                            <h5 class="title"><a href="post-details.html">Microsoft and Bridgestone launch real-time
                                    tire</a></h5>
                        </div>
                    </div>
                    <!-- End Post List  -->
                </div>
                <!-- Start Stories Post  -->

                <!-- Start Stories Post  -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <!-- Start Post List  -->
                    <div class="post-stories content-block mt--30">
                        <div class="post-thumbnail">
                            <a href="post-details.html">
                                <img src="/assets/images/post-single/stories-04.jpg" alt="Post Images">
                            </a>
                        </div>
                        <div class="post-content">
                            <div class="post-cat">
                                <div class="post-cat-list">
                                    <a href="#">COLLABORATION</a>
                                </div>
                            </div>
                            <h5 class="title"><a href="post-details.html">Microsoft and Bridgestone launch real-time
                                    tire</a></h5>
                        </div>
                    </div>
                    <!-- End Post List  -->
                </div>
                <!-- Start Stories Post  -->
            </div>
        </div>
    </div>
    <!-- End More Stories Area  -->
@endsection
