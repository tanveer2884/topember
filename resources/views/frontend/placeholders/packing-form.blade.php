<form id="consult-form">

    <div class="row success-message">
        <div class="col-sm-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                <strong>Congratulations!</strong> Your request for consultation has been successfully submitted.
                <button type="button" class="close close-alert">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" id="uname" placeholder="Name">
                <div class="error d-none">error goes here!</div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" id="uphone" placeholder="Phone number">
                <div class="error d-none">error goes here!</div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <input type="email" class="form-control" id="uemail" placeholder="Email">
                <div class="error d-none">error goes here!</div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <textarea type="text" class="form-control" id="upacking" placeholder="What are you packing?"></textarea>
                <div class="error d-none">error goes here!</div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <textarea type="text" class="form-control" id="usupplies" placeholder="Supplies needed?"></textarea>
                <div class="error d-none">error goes here!</div>
            </div>
        </div>
    </div>
    <!-- continue-button -->
    <div class="consultation-sub-butn">
        <a href="#" class="consultation-butn general-btn">Submit</a>
    </div>
</form>
