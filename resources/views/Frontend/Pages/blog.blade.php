@php

$model = App\Models\Blog::latest()->limit(3)->get();

@endphp

<section class="blog">
    <div class="container">
        <div class="row gx-0 justify-content-center">

            @foreach($model as $key => $value)

            <div class="col-lg-4 col-md-6 col-sm-9">
                <div class="blog__post__item">
                    <div class="blog__post__thumb">
                        <a href="blog-details.html"><img src="{{asset('upload/Blog_images/'.$value->blog_image)}}" alt=""></a>
                        <div class="blog__post__tags">
                            <a href="blog.html">{{ $value->blog_category->category }}</a>
                        </div>
                    </div>
                    <div class="blog__post__content">
                        <span class="date">{{ Carbon\Carbon::parse($value->created_at)->diffForHumans() }}</span>

                        <h3 class="title"><a href="blog-details.html">{{$value->blog_title}}</a></h3>
                        <a href="blog-details.html" class="read__more">Read mORe</a>
                    </div>
                </div>
            </div>

            @endforeach


        </div>
        <div class="blog__button text-center">
            <a href="blog.html" class="btn">more blog</a>
        </div>
    </div>
</section>
