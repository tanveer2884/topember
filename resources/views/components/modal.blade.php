<!-- Modal -->
<div class="modal zoomIn" id="cg-modal" tabindex="-1" role="dialog" aria-labelledby="cg-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cg-modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="h1 text-center"><i class="fa fa-spinner fa-spin"></i></div>
            </div>
        </div>
    </div>
</div>

<script>
    var currentModalRequest= null;
    $('#cg-modal').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        button.removeData('modal-type');
        button.removeData('modal-url');
        button.removeData('modal-content');
        button.removeData('modal-title');

        var modalType = button.data('modal-type');
        var url = button.data('modal-url');
        var title = button.data('modal-title');

        $('#cg-modal-title').html(title);

        if ( modalType == 'html' ){
            modal.find('.modal-body').html(
                button.data('modal-content')
            )
            return;
        }

        currentModalRequest = $.get(url)
            .done(function(data){
                modal.find('.modal-body').html(
                    data
                )
                window.livewire.rescan()
            })
            .fail(function(error){
                console.log(error)
                modal.find('.modal-body').html(
                    `<div class="text-danger h3 text-center"> ${error.status} - ${error.statusText} </div>`
                )
            })
    })

    $('#cg-modal').on('hide.bs.modal',function(){
        $('#cg-modal .modal-body').html(`<div class="h1 text-center"><i class="fa fa-spinner fa-spin"></i></div>`);
        if ( currentModalRequest ){
            currentModalRequest.abort();
        }
    });

    window.livewire.on('close-cg-modal',function (){
        $('#cg-modal').modal('hide')
    });
</script>
