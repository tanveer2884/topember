<script>
    window.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('alert-success', function(message) {
            toastr.success(message)
        })
        window.livewire.on('alert-info', function(message) {
            toastr.info(message)
        })
        window.livewire.on('alert-warning', function(message) {
            toastr.warning(message)
        })
        window.livewire.on('alert-danger', function(message) {
            toastr.error(message)
        })

        window.livewire.on('confirmDelete', function(deleteId) {
            
            if (!confirm("Are you sure to delete this record ?")) {
                return;
            }
            toastr.info('Deleting...')
            window.livewire.emit('delete', deleteId)
        })
    });

</script>
