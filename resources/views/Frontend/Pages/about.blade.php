@php
$model = App\Models\About::find(1);

$galleries = App\Models\MultiImage::all();


@endphp

<section id="aboutSection" class="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <ul class="about__icons__wrap">
                    @foreach($galleries as $key => $gallery)
                    <li>
                        <img class="light" src="{{asset('upload/Multiple_images/'.$gallery->images)}}" alt="XD">

                    </li>
                    @endforeach

                </ul>
            </div>
            <div class="col-lg-6">
                <div class="about__content">
                    <div class="section__title">
                        <span class="sub-title">01 - About me</span>
                        <h2 class="title">{{$model->title}}</h2>
                    </div>
                    <div class="about__exp">
                        <div class="about__exp__icon">
                            <img src="{{asset('frontend/assets/img/icons/about_icon.png')}}" alt="">
                        </div>
                        <div class="about__exp__content">
                            <p>{{$model->short_title}}</p>

                        </div>
                    </div>
                    <p class="desc">{{$model->short_description}}</p>

                    <a href="about.html" class="btn">Download my resume</a>
                </div>
            </div>
        </div>
    </div>
</section>
