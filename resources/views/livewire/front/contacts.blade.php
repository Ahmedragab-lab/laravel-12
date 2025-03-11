<div>
    <section class="contact-us container">
        <div class="mw-930">
            <div class="contact-us__form">
                    <h3 class="mb-5">Get In Touch</h3>

                    <div class="form-floating my-4">
                        <input type="text" class="form-control" wire:model="name" placeholder="Name *" required>
                        <label for="contact_us_name">Name *</label>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-floating my-4">
                        <input type="text" class="form-control" wire:model="phone" placeholder="Phone *" required>
                        <label for="contact_us_phone">Phone *</label>
                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-floating my-4">
                        <input type="email" class="form-control" wire:model="email" placeholder="Email address *" required>
                        <label for="contact_us_email">Email address *</label>
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="my-4">
                        <textarea class="form-control" wire:model="message" placeholder="Your Message" rows="8" required></textarea>
                        @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="my-4">
                        <button type="submit" class="btn btn-primary" wire:click="submit">Submit</button>
                    </div>
            </div>
        </div>

</div>
