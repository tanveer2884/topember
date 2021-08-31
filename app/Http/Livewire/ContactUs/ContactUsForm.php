<?php

namespace App\Http\Livewire\ContactUs;

use App\Mail\ContactUs;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactUsForm extends Component
{
    public $email;
    public $first_name;
    public $last_name;
    public $message;

    public function mount()
    {
        $this->initializeInputs();
    }

    public function render()
    {
        return view('livewire.contact-us.contact-us-form');
    }

    public function submit()
    {
        $data = $this->validate([
            'email' => 'required|email',
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'message' => 'required|max:700',
        ]);

        Mail::send(new ContactUs($data));
        $this->emit('alert-success', 'Your Form Submitted Successfully.');
        $this->initializeInputs();

    }

    public function initializeInputs()
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->message = '';
    }
}
