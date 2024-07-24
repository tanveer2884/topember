<?php

namespace App\Livewire\Frontend\Form;

use Exception;
use App\Models\Contact;
use Livewire\Component;
use App\Mail\ContactUsMail;
use Illuminate\Support\Facades\Mail;

class ContactIndexController extends Component
{
    public string $name = '';

    public string $phone = '';

    public string $email = '';

    public string $message = '';

    public function render()
    {
        return view('livewire.frontend.form.contact-index-controller');
    }

    public function submit(): void
    {
        $data = $this->validate([
            'name' => 'required|max:30',
            'email' => 'required|email:filter,rfc,dns',
            'phone' => 'required|max:30',
            'message' => 'required|max:700',
        ]);

        Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
        ]);

        try {
            Mail::send(new ContactUsMail($data));
            // $this->emit('alert-success', 'Your Form Submitted Successfully.');
            $this->initializeInputs();
        } catch (Exception $exception) {
            // $this->emit('alert-danger', 'Error' . $exception->getMessage());
        }
    }

    public function initializeInputs(): void
    {
        $this->name = '';
        $this->phone = '';
        $this->email = '';
        $this->message = '';
    }
}
