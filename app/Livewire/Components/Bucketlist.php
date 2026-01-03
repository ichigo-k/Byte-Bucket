<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Bucket;
use Illuminate\Database\Eloquent\Builder;

class Bucketlist extends Component
{
    public $search = '';

    public function render()
    {
        $buckets = Bucket::query()
            ->when($this->search, function (Builder $query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.components.bucketlist', [
            'buckets' => $buckets,
        ]);
    }
}
