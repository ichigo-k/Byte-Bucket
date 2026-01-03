<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StorageByType extends Component
{
    public float $totalUsedGb = 0;
    public array $breakdown = [];

    public function mount()
    {
        $this->calculateBreakdown();
    }

    public function calculateBreakdown()
    {
        $user = Auth::user(); // or however you get the current user

        // Raw query to group by type and sum size (in bytes)
        $results = DB::table('items')
            ->select(
                DB::raw("
                    CASE
                        WHEN mime_type LIKE 'image/%' THEN 'Images'
                        WHEN mime_type LIKE 'video/%' THEN 'Videos'
                        WHEN mime_type LIKE 'audio/%' THEN 'Audio'
                        WHEN mime_type IN (
                            'application/zip',
                            'application/x-rar-compressed',
                            'application/x-tar',
                            'application/gzip',
                            'application/x-7z-compressed'
                        ) THEN 'Archives'
                        WHEN mime_type LIKE 'application/vnd.%'
                             OR mime_type LIKE 'text/%'
                             OR mime_type IN (
                                 'application/msword',
                                 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                 'application/vnd.ms-excel',
                                 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                 'application/vnd.ms-powerpoint',
                                 'application/pdf'
                             ) THEN 'Documents'
                        ELSE 'Others'
                    END as category
                "),
                DB::raw('SUM(size) as total_bytes')
            )
            ->where('user_id', $user->id)
            ->where('is_folder', false)
            ->groupBy('category')
            ->orderByDesc('total_bytes')
            ->get();

        $totalBytes = $results->sum('total_bytes');
        $this->totalUsedGb = $totalBytes > 0 ? round($totalBytes / (1024 ** 3), 2) : 0;

        $this->breakdown = $results->map(function ($row) use ($totalBytes) {
            $bytes = $row->total_bytes;
            $gb = $bytes > 0 ? round($bytes / (1024 ** 3), 2) : 0;
            $percentage = $totalBytes > 0 ? round(($bytes / $totalBytes) * 100, 1) : 0;

            return [
                'category'   => $row->category,
                'gb'         => $gb,
                'percentage' => $percentage,
                'color'      => $this->getColorForCategory($row->category),
            ];
        })->toArray();


        if ($this->totalUsedGb == 0) {
            $this->breakdown = [[
                'category'   => 'No files yet',
                'gb'         => 0,
                'percentage' => 0,
                'color'      => 'gray',
            ]];
        }
    }

    private function getColorForCategory(string $category): string
    {
        return match ($category) {
            'Images'     => '#ffb703',
            'Videos'     => 'purple',
            'Documents'  => '#c9184a',
            'Audio'      => '#7b2cbf',
            'Archives'   => 'indigo',
            default      => '#ffd500',
        };
    }

    public function render()
    {
        return view('livewire.components.storage-by-type');
    }
}
