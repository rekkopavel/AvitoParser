<?php

namespace App\Livewire\Dashboard;

use App\Models\Subscriber;
use Livewire\Component;

class SubscriberManager extends Component
{
    public $subscribers;
    public $name, $telegram_id, $mail, $active, $id;
    public $creating = false, $editing = false;


    public function mount()
    {
        $this->subscribers = Subscriber::all();
    }


    public function create()
    {
        $this->resetForm();
        $this->creating = true;
    }


    public function edit($id)
    {
        $subscriber = Subscriber::find($id);
        $this->name = $subscriber->name;
        $this->telegram_id = $subscriber->telegram_id;
        $this->mail = $subscriber->mail;
        $this->active = $subscriber->active;
        $this->id = $subscriber->id;
        $this->editing = true;
    }


    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'telegram_id' => 'required|int',
            'mail' => 'nullable|mail|max:255',
            'active' => 'required|boolean',
        ]);

        Subscriber::create([
            'name' => $this->name,
            'telegram_id' => $this->telegram_id,
            'mail' => $this->mail,
            'active' => $this->active,
        ]);

        $this->resetForm();
        $this->subscribers = Subscriber::all();
    }


    public function update()
    {

        $this->validate([
            'name' => 'required|string|max:255',
            'telegram_id' => 'required|int',
            'mail' => 'nullable|email|max:255',
            'active' => 'required|boolean',

        ]);

        $subscriber = Subscriber::find($this->id);


        $subscriber->update([
            'name' => $this->name,
            'telegram_id' => $this->telegram_id,
            'mail' => $this->mail,
            'active' => $this->active,
        ]);


        $this->resetForm();
        $this->subscribers = Subscriber::all();
    }


    public function delete($id)
    {
        $subscriber = Subscriber::find($id);
        if ($subscriber) {
            $subscriber->delete();
        }

        $this->subscribers = Subscriber::all();
    }


    private function resetForm()
    {
        $this->name = '';
        $this->telegram_id = '';
        $this->mail = '';
        $this->active = false;
        $this->id = null;
        $this->creating = false;
        $this->editing = false;
    }

    public function render()
    {
        return view('livewire.dashboard.subscriber-manager');
    }
}
