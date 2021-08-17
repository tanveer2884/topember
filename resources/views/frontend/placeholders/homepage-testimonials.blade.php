@foreach (getHomepageTestimonials() as $testimonial)
<div class="customer-testimonial-text">
    <h2 class="section-heading">{{ $testimonial->title }}</h2>
    <p>{!! $testimonial->description !!}</p>
    <span>{{ $testimonial->name }}</span>
</div>
@endforeach