<footer style="background-color: #000;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="footer-links">
                    <h3 class="footer-head">Quick Link</h3>
                    <ul>
                        @foreach (getMenu('quick-links') as $menuItem)
                            <li>
                                <a href="{{ url($menuItem->link) }}">{{ $menuItem->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="footer-links div-float">
                    <div class="footer-social-main"> 
                        <h3 class="footer-head">Social media</h3>
                        <div class="footer-social">
                            <ul>
                                <li>
                                    <a href="{{ getGeneralSetting('facebook_url','#') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="11" height="23" viewBox="0 0 11 23">
                                            <image width="11" height="23" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAAXCAYAAADduLXGAAAA3UlEQVQ4je2TPYoCQRCFP0dNFsFEDEWEBTHY0MAbeAID2Vy8yaQmXkDB1FivYLIYaCAiCP6wmggmAyoNPVA+ZoLNt6Bp6tXX1a/p7kwYhkj0gW+g5uU7cAZ+cgIOgZ6uBqrAV2CEVgoYx9x2bicAa2AJlIGZhUsCboC6FayNrMA73cbCF6k9FXY2On5uSq0CdE2+ctBEO/j4BEYmHwQpYFJsHXwFIuCR4DkyY+/ghvc3Fnjh9XhMneeTL/4K7N7E0QrW84fAefX9lwP+w6lwQWpFhe1PcTd4M/nhjQReDe4ktJ+5u04AAAAASUVORK5CYII="/>
                                        </svg> 
                                        Facebook
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ getGeneralSetting('twitter_url','#') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22" height="18" viewBox="0 0 22 18">
                                            <image width="22" height="18" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAASCAYAAABfJS4tAAABh0lEQVQ4jaXUP0iWURTH8Y+iRSIWDUFBSENIf7aaGhqkoRLCgppaGlpcg6CExuhd3NrEpqaWJBEcGhoyh6BoiKJaQrRA0GrJoowDR3h4eB/uq/3g8tx7zz3fc+9zz7ldrVbLFrUXdzCCAXzEA0ym/SzWetCHhxjH2wJ0H15jf23uVAbqxYHod2MQo5jHsQL4UQ1a1WjCn2E4wLvSuBtvMNbgeBinC4HXcRUr3Xn89TTE+D5e4loGqzqV9APHMRf/+CcuYrbidAJTmMCLDBRB/+a3SYv4GrYAH8EfzOB8zXEPzmULbRR2/Guz05O7mMMyugqOJfu7zU7s7j2e5G2XHEuar4LlTb76T2houg7+nv8xLmt1m9DH+FIHh4ZwCTu3Cb5ZHVTBkVafssS3qnv40AT+jTO4gadY6hAeJXyrPtku2SeyrFc6gEYWDLczRB4fwo5MtaO4gCuVN6RJ8UxebzIGOJ6521l1neg57taegLbgWHg5jxTtJA6iP9d8w+e83CikhWJ0/AMDX0c4GPaTYQAAAABJRU5ErkJggg=="/>
                                        </svg> 
                                        Twitter
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ getGeneralSetting('instagram_url','#') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19" height="19" viewBox="0 0 19 19">
                                            <image width="19" height="19" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAATCAYAAAByUDbMAAABgElEQVQ4jZ3UP0jVURQH8E+vVwnujUZJhENBhEotLUpJEP2hsUWamtqC3HR6m7Q01eAoJKjRQydBIgeLotBoKiGXxoYiJOXK+cHlcV8+3xcu53DPPd/fued3vvdIo9GAq5jAJRxzMI7GuR18wBSadQxjpQOCEhLhZbzGSA3TXZC8xJVY92PvearsYhdkW3gb/mbYU6myf12Q5fhb+fVo4mExgkbknAz7p35AZZ8xiS84gycYwvlYOX4nsh78wrMI9OMuvuICdmP/E+axHiP0ChsRe4De1LMT+InHsaoxeZQR5XgY/rss50fiqUUgH9QbYd//5+r5OVGQWuHwVtjWnlQ4F/Zba6BENhP2aRuyqrcvOiF7g0UMhO7Sdc5iNGJJfqtJi62J9TZfv4k53I6/lmMZt0pJFVlpcO9gLIj7sB0VLxTO7uRkvW0qbJauU0Ca1f2eJaEmSdzrIKmEa6GO7VTZeLwAs/ieNHYIouM4Hf54IlvD9XgtB7uo7OO+flnaA8HbSBfQjRfCAAAAAElFTkSuQmCC"/>
                                        </svg> 
                                        Instagram
                                    </a>
                                </li>
                            </ul>  
                        </div>
                    </div>
                    
                    <div class="newsletter">
                        <h3 class="footer-head">Sign Up for Newsletter</h3>  
                        <p>Sign up to receive our newsletter & special offers</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Email address">
                                <div class="input-group-append">
                                    <button class="btn" type="submit">Send</button>  
                                </div>
                            </div>
                            <div class="error d-none">Fill the required field</div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="all-rights-main div-flex"> 
                    {!! getGeneralSetting('copyright_text','') !!}
                    <ul>
                        @foreach (getMenu('footer-links') as $menuItem)
                            @if ($loop->index !=0 )
                                <li class="pipe">|</li>
                            @endif
                            <li>
                                <a href="{{ url($menuItem->link) }}">{{ $menuItem->title }}</a>
                            </li>
                        @endforeach
                    </ul> 
                </div>
            </div>
        </div>
    </div>
</footer>