<?php

namespace App\Http\Livewire\Admcategorias;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Categoria;

class Admcategorias extends Component
{

    use WithPagination;
    public $npagination = '10';
    protected $paginationTheme = 'bootstrap';
    public $keyWord;
    protected $listeners = ['render' => 'render'];
    public $sort = 'id';
    public $direction = 'desc';
    public $id_categoria;
    public $ids_categoria = array();
    public $titulo;

    public function render()
    {


        $keyWord = '%' . $this->keyWord . '%';

        return view(
            'livewire.admcategorias.admcategorias',
            [
                'categorias' => Categoria::Where('titulo', 'LIKE', $keyWord)
                    ->orWhere('created_at', 'LIKE', $keyWord)
                    ->orWhere('updated_at', 'LIKE', $keyWord)

                    ->orderBy($this->sort, $this->direction)
                    ->paginate($this->npagination),
            ]
        );
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
            'titulo' => 'required'

        ]);

        Categoria::create($validatedData);

        $this->resetInput();

        $this->emit('store');
    }
    public function edit($id)
    {
        $categoria = Categoria::findOrfail($id);
        $this->titulo = $categoria->titulo;
        $this->ChangeId($id);
    }



    public function update()
    {
        $validatedData = $this->validate([
            'titulo' => 'required'

        ]);
        Categoria::where('id', $this->id_categoria)->update($validatedData);

        $this->emit('update');
    }
    public function resetInput()
    {
        $this->titulo = null;
    }
    public function cancel()
    {

        $this->resetInput();
    }
    public function destroy($option = '')
    {

        if ($option == "MultipleDelete") {
            Categoria::destroy($this->ids_categoria);
            $this->ids_categoria = array();
            $this->emit('MultipleDelete');
        } else {
            Categoria::destroy($this->id_categoria);
            $this->emit('delete');
            $clave = array_search($this->id_categoria, $this->ids_categoria);
            if ($clave !== false) {
                unset($this->ids_categoria[$clave]);
            }
        }
    }
    public function ChangeId($id)
    {
        $this->id_categoria = $id;
    }
    public function checkbox($id)
    {


        $clave = array_search($id, $this->ids_categoria);
        if ($clave !== false) {
            unset($this->ids_categoria[$clave]);
        } else {
            array_push($this->ids_categoria, $id);
        }
        $this->StatusButtonTrash();
    }

    public function StatusButtonTrash()
    {
        if (count($this->ids_categoria) > 0) {
            $this->emit('VisibilityMultipleButtonTrash', true);
        } else {
            $this->emit('VisibilityMultipleButtonTrash', false);
        }
    }
}
