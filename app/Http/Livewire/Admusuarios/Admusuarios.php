<?php

namespace App\Http\Livewire\Admusuarios;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Admusuarios extends Component
{
    use WithPagination;
    public $npagination = '10';
    protected $paginationTheme = 'bootstrap';
    public $keyWord;
    protected $listeners = ['render' => 'render'];
    public $sort = 'id';
    public $direction = 'desc';
    public $ids=array();
    public $nombre;
    public $apellido;
    public $rol;
    public $password;
    public $tipo_identidad;
    public $identificacion;
    public $contacto;
    public $email;
    public $id_user;
    public function render()
    {
         if( Auth::user()->rol=='SuperAdmin' ) {
        $keyWord = '%' . $this->keyWord . '%';

        return view('livewire.admusuarios.admusuarios',

        [
            
            'users' => User::Where('nombre', 'LIKE', $keyWord)
                ->orWhere('apellido', 'LIKE', $keyWord)
                ->orWhere('rol', 'LIKE', $keyWord)
                ->orWhere('identificacion', 'LIKE', $keyWord)
                ->orWhere('tipo_identidad', 'LIKE', $keyWord)
                ->orWhere('contacto', 'LIKE', $keyWord)
                ->orWhere('email', 'LIKE', $keyWord)
                ->orWhere('created_at', 'LIKE', $keyWord)
                ->orWhere('updated_at', 'LIKE', $keyWord)

                ->orderBy($this->sort, $this->direction)
                ->paginate($this->npagination),
        ]);


    }
    else {
        // El usuario autenticado no tiene permiso para acceder a la lista de usuarios.
        abort(403);
    }
    }
    
    public function change()
    {
        $this->emit('render');
    }
    public function order($sort)
    {


        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }
    public function store()
    {

        
        $validatedData = $this->validate([
            'nombre' => ['required','string', 'max:40'],
            'apellido' => ['required', 'string', 'max:40'],
            'rol' => ['required'],   
            'identificacion' => ['required','numeric', 'unique:users'],
            'tipo_identidad' => ['required'],
            'email' => ['required','unique:users', 'string', 'max:40'],
            'password' => ['required', 'string', 'min:6' ],
            'contacto'=> ['required', 'numeric', 'min:5'],
            
        ]);
           $validatedData['password'] = bcrypt($validatedData['password']);
            User::create($validatedData);

            $this->resetInput();
    
            $this->emit('store');
        
    }
    public function edit($id)
    {
        $this->id_user=$id;
        $user = User::find($id);
        $this->nombre = $user->nombre;
        $this->apellido = $user->apellido;
        $this->rol = $user->rol;
        $this->tipo_identidad = $user->tipo_identidad;
        $this->identificacion = $user->identificacion;
        $this->password = $user->password;
        $this->contacto = $user->contacto;
        $this->email = $user->email;
        $this->ChangeId($id);
    }
    public function update()
    {
        
        $validatedData = $this->validate([
            'nombre' => ['required','string', 'max:40'],
            'apellido' => ['required', 'string', 'max:40'],
            'rol' => ['required'],   
            'identificacion' => ['required','numeric'],
            'tipo_identidad' => ['required'],
            'email' => ['required', 'string', 'max:40'],
            'contacto'=> ['required', 'numeric', 'min:5'],

        ]);
       
        User::where('id',  $this->id_user)->update($validatedData);
        $this->emit('update');
    }
    public function updatePassword(){
        $validatedData = $this->validate([
    
            'password' => ['required', 'string', 'min:6']
            
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        User::where('id',  $this->id_user)->update($validatedData);
        $this->emit('updatePassword');
    }
    public function resetInput()
    {
        $this->nombre = null;
        $this->apellido = null;
        $this->rol = null;
        $this->identificacion = null;
        $this->tipo_identidad = null;
        $this->email = null;
        $this->contacto = null;

    }
    public function cancel()
    {

        $this->resetInput();
    }
    public function destroy()
    {

            User::where('id', $this->id_user)->delete();
            $this->emit('delete');
           
    }
    
    public function ChangeId($id)
    {       
        
        $this->id_user = $id;

    }
    public function checkbox($id)
    {


        $clave = array_search($id, $this->id_user);
        if ($clave !== false) {
            unset($this->id[$clave]);
        } else {
            array_push($this->id, $id);
        }
        $this->StatusButtonTrash();
    }
    public function StatusButtonTrash()
    {
        if (count($this->id) > 0) {
            $this->emit('VisibilityMultipleButtonTrash', true);
        } else {
            $this->emit('VisibilityMultipleButtonTrash', false);
        }
    }
}


