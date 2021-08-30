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
        <h4>What are you shipping?</h4>
        <div class="col-sm-12">
            <div class="form-group">
                <textarea class="form-control" id="ushipitems" placeholder="What are you shipping?"></textarea>
                <div class="error d-none">error goes here!</div>
            </div>
        </div>

        <h4>Is the item fragile?</h4>
        <div class="multi-radio">
            <div class="form-group ch-box-1">
                <input type="radio" name="fragile" class="d-none" id="f-yes">
                <label for="f-yes">Yes</label>
            </div>
            <div class="form-group ch-box-1 w-auto">
                <input type="radio" name="fragile" class="d-none" id="f-no">
                <label for="f-no">No</label>
            </div>
        </div>

        <h4>Is the item large?</h4>
        <div class="multi-radio">
            <div class="form-group ch-box-1">
                <input type="radio" name="largeitem" class="d-none" id="large-yes">
                <label for="large-yes">Yes</label>
            </div>
            <div class="form-group ch-box-1 w-auto">
                <input type="radio" name="largeitem" class="d-none" id="large-no">
                <label for="large-no">No</label>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <input type="number" class="form-control" id="totalitems" placeholder="Number of Items">
                <div class="error d-none">error goes here!</div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <textarea type="text" class="form-control nw-txt-area" id="exampleFormControlInput1" placeholder="How quickly do you want to ship it?"></textarea>
                <div class="error d-none">error goes here!</div>
            </div>
        </div>
        <h4>Do you need packing services:</h4>
        <div class="form-group ch-box-1 w-100">
            <input type="checkbox" class="d-none" id="yes">
            <label for="yes">Yes -- please pack for me</label>
        </div>

        <div class="form-group ch-box-1 w-100">
            <input type="checkbox" class="d-none" id="specification">
            <label for="specification" onclick="showInput()">I need packing materials</label>
        </div>
        <div class="col-sm-12 d-none" id="nw-txt-area-Two">
            <div class="form-group">
                <textarea type="text" class="form-control" id="exampleFormControlInput1" placeholder="What supplies do you need?"></textarea>
                <div class="error d-none">error goes here!</div>
            </div>
        </div>

        <div class="form-group ch-box-1 w-100">
            <input type="checkbox" class="d-none" id="no">
            <label for="no">No, I will pack on my own</label>
        </div>
    </div>
    <!-- continue-button -->
    <div class="consultation-sub-butn">
        <a href="#" class="consultation-butn general-btn">Submit</a>
    </div>
</form>
