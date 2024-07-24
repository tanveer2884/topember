<div class="row portfolio-fade wow" data-wow-delay=".8s">
    <div class="col-sm-12">
        <div class="text-center team-classic owl-team owl-carousel">
            <!-- Item 1 -->
            @foreach($projects as $project)
            <div class="item">
                <div class="team-data-img">
                    <a href="{{$project->getThumbnailUrl()}}" data-fancybox="portfolio-images">
                        <div class="single-work">
                            <img src="{{ $project->getThumbnailUrl() }}" alt="team" class="img-responsive" data-no-retina>
                            <div class="overlay-text center-block">
                                <div class="cases-image-inner">
                                    <span class="cases-line top"></span>
                                    <span class="cases-line top-right"></span>
                                    <span class="cases-line bottom"></span>
                                    <span class="cases-line bottom-left"></span>
                                    <div class="image-overlay">
                                        {{-- <div class="search-icon"><i class="fa fa-search"></i></div> --}}
                                        <span class="text-white text-uppercase alt-font">{!! $project->description !!}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="portfolio-content" style="text-align: center;">
                        <a href="{{$project->link}}" target="_blank" class="mb-2 text-yellow main-font text-uppercase">{{$project->title}}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-4 row justify-content-center">
            <a href="portfolio.html"
                class="mt-4 mb-2 btn btn-medium btn-rounded btn-trans text-capitalize mb-md-0">Learn
                More</a>
        </div>
        <a class="circle ini-customPrevBtn" id="team-circle-left">
            <i class="lni-chevron-left"></i>
        </a>
        <a class="circle ini-customNextBtn" id="team-circle-right">
            <i class="lni-chevron-right"></i>
        </a>
    </div>
</div>