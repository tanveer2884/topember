<!-- <script src="js/jquery-3.5.1.min.js"></script>   -->
<script src="{{ asset('js/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>  
<script src="{{ asset('js/popper.min.js') }}"></script> 
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> 
{{-- <script src="{{ asset('js/custom_one.js') }}"></script>  --}}

<script>
    function debounce(n,t,u){var e;return function(){var i=this,o=arguments,a=u&&!e;clearTimeout(e),e=setTimeout(function(){e=null,u||n.apply(i,o)},t),a&&n.apply(i,o)}}
</script>