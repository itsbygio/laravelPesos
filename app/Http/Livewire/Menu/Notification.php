<?php

namespace App\Http\Livewire\Menu;

use Livewire\Component;

class Notification extends Component
{
    public $CartShop;
    public $total_cart;
    public $cantidades;
    protected $listeners = ['GetDataCart' => 'GetDataCart'];

    public function render()
    {
        return view('livewire.menu.notification');
    }
    public function GetDataCart($data){
          $this->CartShop =$data['CartShop'];
          $this->total_cart =$data['total_cart'];
          $this->cantidades =$data['cantidades'];
    }
}
