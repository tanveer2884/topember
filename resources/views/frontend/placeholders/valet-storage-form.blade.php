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
                <input type="text" class="form-control" id="uphone" placeholder="Phone Number">
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
                <input type="text" class="form-control" id="flaterateid" placeholder="FlatRate ID">
                <div class="error d-none">error goes here!</div>
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
                <select name="umethod" id="umethod" class="form-control select-arrow">
                    <option value="">Pickup or Drop off</option>
                    <option value="pickup">Pickup</option>
                    <option value="dropoff">Drop off</option>
                </select>
                <div class="error d-none">error goes here!</div>
            </div>
        </div>
        <!-- <h5>Pickup or Drop off:</h5>
        <div class="quantity-input-cont">
            <span class="input-number-decrement">–</span>
            <input class="input-number" type="text" value="1" min="1" max="100">
            <span class="input-number-increment">+</span>
        </div> -->
        <!-- <div class="col-sm-12">
            <div class="form-group">
                <input type="time" class="form-control" id="utime" placeholder="Time">
                <div class="error d-none">error goes here!</div>
            </div>
        </div> -->
        <!-- <div class="col-sm-12">
            <div class="form-group">
                <textarea type="text" class="form-control" id="exampleFormControlInput1" placeholder="What supplies do you need?"></textarea>
                <div class="error d-none">error goes here!</div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <textarea type="text" class="form-control" id="exampleFormControlInput1" placeholder="What are you shipping?"></textarea>
                <div class="error d-none">error goes here!</div>
            </div>
        </div> -->
    </div>
    <!-- continue-button -->
    <div class="consultation-sub-butn">
        <a href="#" class="consultation-butn general-btn">Submit</a>
    </div>
</form>
