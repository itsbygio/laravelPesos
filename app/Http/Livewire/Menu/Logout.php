<?php

namespace App\Http\Livewire\Menu;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function render()
    {
        return view('livewire.menu.logout');
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        redirect('/login');
       // return redirect()->to('/login');
    }
}
