<section class="section slide5 contact-sec" id="contact">
    <div class="bg-overlay bg-red opacity-9"></div>
    <div class="container expand-container">
        <div class="row">
            <div class="col-12 col-lg-7 section6left wow" data-wow-delay=".8s">
                <h4 class="text-center heading text-md-left main-font">Questions?<span class="d-block">Let's Get
                        In
                        Touch</span></h4>
                <form wire:submit="submit" class="row contact-form wow fadeInLeft" id="contact-form-data">
                    <div class="col-12 col-lg-8" id="result"></div>
                    <div class="col-12 col-lg-8">
                        <input type="text" name="userName" placeholder="Name" class="form-control" wire:model="name">
                        @error('name')<div class="error">{{ $message }}</div>@enderror
                        <input type="text" name="userPhone" placeholder="Contact No" class="form-control" wire:model="phone">
                        @error('phone')<div class="error">{{ $message }}</div>@enderror
                        <input type="email" name="userEmail" placeholder="Email" class="form-control" wire:model="email">
                        @error('email')<div class="error">{{ $message }}</div>@enderror
                        <textarea class="form-control" name="userMessage" rows="6" placeholder="Type Your Message Here" wire:model="message"></textarea>
                        @error('message')<div class="error">{{ $message }}</div>@enderror
                        <button type="submit"
                            class="btn btn-medium btn-rounded btn-white rounded-pill w-100 contact_btn main-font">Submit
                            Information</button>
                    </div>
                </form>
            </div>
            <div class="text-center col-12 col-lg-5 section6left wow text-lg-left d-flex align-items-center"
                data-wow-delay=".8s">
                <div class="contact-details wow fadeInRight">
                    <h4 class="heading main-font">Office Location</h4>
                    <p class="text alt-font">There are many variations of passages of Lorem Ipsum available, but
                        themajority have suffered..</p>
                    <ul>
                        <li><i aria-hidden="true" class="fas fa-map-marker-alt"></i> 123 Park Avenue, New York,
                            United States </li>
                        <li><i aria-hidden="true" class="fas fa-phone-volume"></i>
                            <span>+1 631 1234 5678</span>
                            <span>+1 631 1234 5678</span>
                        </li>
                        <li><i aria-hidden="true" class="fas fa-paper-plane"></i>email@website.com</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>