<div class="row team-fade wow" data-wow-delay=".8s">
    <div class="col-sm-12">
        <div id="team-slider" class="owl-carousel owl-theme wow fadeInUp">
            <!--Team Item-->
            @foreach($members as $member)
            <div class="team-box item">
                <div class="team-image">
                    <img src="{{ $member->getThumbnailUrl() }}" alt="image">
                </div>
                <!--Team Text-->
                <div class="team-text">
                    <h5 class="main-font">{{$member->title}}</h5>
                    <span class="alt-font">{{$member->designation}}</span>
                    <div class="team-social">
                        <ul class="list-unstyled">
                            <li><a class="twitter-bg-hvr" href="{{$member->twitter}}"><i class="fab fa-twitter"
                                        aria-hidden="true"></i></a></li>
                            <li><a class="google-bg-hvr" href="{{$member->google}}"><i class="fab fa-google-plus-g"
                                        aria-hidden="true"></i></a></li>
                            <li><a class="linkedin-bg-hvr" href="{{$member->linkedin}}" target="_blank"><i class="fab fa-linkedin-in"
                                        aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>