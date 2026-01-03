<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class TotalUserStorage extends Component
{
    public float $used = 0.0;
    public float $total = 100.0;
    public bool $showText = true;


    public float $percentage = 0.0;
    public bool $isWarning = false;
    public bool $isDanger = false;

    public function mount()
    {
        $user = Auth::user();


        $this->used = $this->calculateUsedStorage($user);
        $this->total = $user->maxStorageBytes() / (1024 ** 3);

        $this->calculatePercentageAndStatus();
    }

    private function calculateUsedStorage($user): float
    {

        return $user->totalStorageUsed();
    }

    private function calculatePercentageAndStatus(): void
    {
        $this->percentage = $this->total > 0 ? ($this->used / $this->total) * 100 : 0;
        $this->isWarning = $this->percentage >= 80;
        $this->isDanger = $this->percentage >= 95;
    }

    public function render()
    {
        return view('livewire.components.total-user-storage');
    }
}
