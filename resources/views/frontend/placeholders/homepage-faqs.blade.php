@foreach (getHomepageFaqs() as $faq)
<div class="card">
    <div class="card-header collapsed cursor-pointer" data-toggle="collapse" href="#collapseOne{{$faq->id}}" aria-expanded="true">
        {{ $faq->question }}
    </div>
    <div id="collapseOne{{$faq->id}}" class="card-body show collapse" data-parent="#accordion">
        <div class="faq-text">
            {!! $faq->answer !!}
        </div>
    </div>
</div>
@endforeach
