<!-- <script src="js/jquery-3.5.1.min.js"></script>   -->
<script src="{{ asset('js/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>

<script>
    function debounce(n, t, u) {
        var e;
        return function() {
            var i = this,
                o = arguments,
                a = u && !e;
            clearTimeout(e), e = setTimeout(function() {
                e = null, u || n.apply(i, o)
            }, t), a && n.apply(i, o)
        }
    }

    $(document).ready(function() {

        $('body').on('keyup input paste', '.phone_number', function() {
            $(this).mask('+1 (999) 999-9999')
        })

        $('body').on('keyup input paste', '.month', function() {
            let val = $(this).val();
            if ( val == '' ){
                return;
            }

            if (/^(0?[1-9]$)|(^1[0-2])$/i.test(val)){
                $(this).mask('00')
            }else{
                $(this).val(12);
            }
        })

        $('body').on('keyup input paste', '.year', function() {
            let val = $(this).val();
            if ( val =='' ){
                return;
            }
            
            $(this).mask('0000')
        })

        $('body').on('keyup input paste', '.card_number', function() {
            let val = $(this).val();
            val = val.replace(/-/g, "");
            if (/^3$|^3[47][0-9]{0,13}$/i.test(val)) {
                $(this).mask('0000-000000-00000')
            } else {
                $(this).mask('0000-0000-0000-0000')
            }
        })

        $('.phone_number').trigger('input');
        $('.card_number').trigger('input');

    });
</script>
