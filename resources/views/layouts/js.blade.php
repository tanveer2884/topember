<!-- BEGIN: Vendor JS-->
<script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>

<!-- BEGIN: Theme JS-->
<script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('app-assets/js/core/app.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/components.js') }}"></script>
<!-- END: Theme JS-->

<!-- END: Page JS-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>

<script src="https://cdn.tiny.cloud/1/tovotida9gox0op1hr84i592n0kd5bdpj2ze4lrlgg4x9vb1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Global Vendors -->
{{-- <script src="{{ asset('js/manifest.js') }}"></script>
<script src="{{ asset('js/vendor.js') }}"></script>
 <script src="{{ asset('js/app.js') }}"></script> --}}
<script>
    function confirmDelete() {
        return confirm("Are you Sure you want to delete?");
    }

    function loadJsAsync(src, time) {
        $(document).ready(function() {
            setTimeout(function() {
                let script = document.createElement('script');
                script.src = src;
                document.body.append(script);
            }, time)
        })
    }

    $(document).ready(function() {
        $('.selectpicker').select2({
            allowClear: true
        });
        $('body').on('input','.slug-from',function(){


            $( $(this).data('slug-to') ).val(
                $(this).val().toString()
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '')
                    .toLowerCase()
                    .trim()
                    .replace(/\s+/g, '-')
                    .replace(/[^\w-]+/g, '')
                    .replace(/--+/g, '-')
            )
        })
    });

    document.addEventListener("livewire:load", () => {
        window.livewire.hook('message.processed', (message, component) => {
            $('.selectpicker').select2();
        });
    });

    $('form').on('submit', function() {
        $('form button[type="submit"]').attr('disabled', 'disabled');
    });

    if (document.getElementsByClassName('editor').length > 0) {
        tinymce.init({
            selector: '.editor',
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount media code hr'
            ],
            toolbar1: 'undo redo | formatselect | fontsizeselect | bold italic backcolor | \
                    alignleft aligncenter alignright alignjustify | \
                    bullist numlist outdent indent | removeformat | image | media | link | hr | code |fullscreen',
            fontsize_formats: "8pt 9pt 10pt 11pt 12pt 14pt 18pt 24pt 30pt 36pt 48pt 60pt 72pt 96pt",
            content_style: "p { margin: 0; }",
            file_picker_types: 'image',
            image_title: true,
            toolbar_mode: 'floating',
            relative_urls: false,
            remove_script_host: false,
            convert_urls: false,
            images_upload_handler: (blobInfo, success, failure, progress) => {
                var formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                axios.post('{{ Route::has("api.tinymce.medias.store") ? route("api.tinymce.medias.store") : ''}}', formData)
                    .then(response => {
                        if (response.data) {
                            success(response.data.location);
                            return;
                        }
                        failure('Image upload failed. Code: ' + error.response.data, {
                            remove: true
                        });
                    }).catch(error => {
                        failure('Image upload failed. Code: ' + error.response, {
                            remove: true
                        });
                    })
            }
        });
    }
</script>
