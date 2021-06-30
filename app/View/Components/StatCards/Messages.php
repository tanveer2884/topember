<?php

namespace App\View\Components\StatCards;

use Modules\User\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Messages extends Component
{
    public $messages;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $query = Message::query();

        if ( Auth::user()->isUser() ){
            $query->where('user_id',Auth::id());
        }

        $this->messages = $query->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.stat-cards.messages');
    }
}
