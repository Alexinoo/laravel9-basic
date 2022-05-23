@extends('Frontend.frontend_master')

@section('content')

<!-- banner-area -->
@include('Frontend.Pages.banner')
<!-- banner-area-end -->



<!-- about-area -->
@include('Frontend.Pages.about')

<!-- about-area-end -->




<!-- services-area -->
@include('Frontend.Pages.services')

<!-- services-area-end -->





<!-- work-process-area -->
@include('Frontend.Pages.work')
<!-- work-process-area-end -->




<!-- portfolio-area -->
@include('Frontend.Pages.portfolio')
<!-- portfolio-area-end -->




<!-- partner-area -->
@include('Frontend.Pages.partners')

<!-- partner-area-end -->





<!-- testimonial-area -->
@include('Frontend.Pages.testimonials')
<!-- testimonial-area-end -->





<!-- blog-area -->
@include('Frontend.Pages.blog')
<!-- blog-area-end -->




<!-- contact-area -->
@include('Frontend.Pages.contact')
<!-- contact-area-end -->




@endsection
