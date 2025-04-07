<?php

namespace App\Livewire\Dashboard;

use App\Models\Query;
use Livewire\Component;

class QueryManager extends Component
{
    public $queries;
    public $title, $uri, $city, $status, $queryId;
    public $creating = false, $editing = false;


    public function mount()
    {
        $this->queries = Query::all();
    }


    public function create()
    {
        $this->resetForm();
        $this->creating = true;
    }


    public function edit($id)
    {
        $query = Query::find($id);
        $this->title = $query->title;
        $this->uri = $query->uri;
        $this->city = $query->city;
        $this->status = $query->status;
        $this->queryId = $query->id;
        $this->editing = true;
    }


    public function store()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'uri' => 'required|url',
            'city' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        Query::create([
            'title' => $this->title,
            'uri' => $this->uri,
            'city' => $this->city,
            'status' => $this->status,
        ]);

        $this->resetForm();
        $this->queries = Query::all();
    }


    public function update()
    {

        $this->validate([
            'title' => 'required|string|max:255',
            'uri' => 'required|url',
            'city' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        $query = Query::find($this->queryId);


        $query->update([
            'title' => $this->title,
            'uri' => $this->uri,
            'city' => $this->city,
            'status' => $this->status,
        ]);


        $this->resetForm();
        $this->queries = Query::all();
    }


    public function delete($id)
    {
        $query = Query::find($id);
        if ($query) {
            $query->delete();
        }

        $this->queries = Query::all();
    }


    private function resetForm()
    {
        $this->title = '';
        $this->uri = '';
        $this->city = '';
        $this->status = false;
        $this->queryId = null;
        $this->creating = false;
        $this->editing = false;
    }

    public function render()
    {
        return view('livewire.dashboard.query-manager');
    }
}
