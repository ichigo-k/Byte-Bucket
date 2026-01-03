<?php

namespace App\Livewire;

use App\Models\Bucket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[layout('components.layouts.auth')]
class CreateBucket extends Component
{
    public string $name = '';
    public string $type = 'standard';

    protected $rules = [
        'name' => 'required|string|min:3|max:255|regex:/^[a-z0-9][a-z0-9\-]*[a-z0-9]$/',
        'type' => 'required|in:standard,archival,deep_archive',
    ];

    protected $messages = [
        'name.regex' => 'Bucket name may only contain lowercase letters, numbers, and hyphens. It must start and end with a letter or number.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createBucket()
    {
        $this->validate();

        Bucket::create([
            'user_id'             => Auth::id(),
            'name'                => $this->name,
            'type'                => $this->type,
            'physical_bucket_name' => Auth::user()->id . '-' . Str::lower($this->name),
        ]);

        session()->flash('message', 'Bucket created successfully.');
//        return $this->redirectRoute('buckets.index');
    }

    public function render()
    {
        return view('livewire.create-bucket');
    }
}
