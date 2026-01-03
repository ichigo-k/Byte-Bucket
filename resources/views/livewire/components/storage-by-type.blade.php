<div class="md:w-3/4 w-full p-5 rounded-xl shadow-sm border bg-light-black border-white/15">
    <div class="">
        <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
            Storage by file type
        </h3>

        @if($totalUsedGb == 0)
            <p class="text-xs text-gray-500 dark:text-gray-400 text-center py-6">
                No files uploaded yet.
            </p>
        @else
            <div class="space-y-3">
                @foreach($breakdown as $item)
                    <div class="flex items-center gap-3">
                        <div class="w-28 text-xs font-medium text-gray-700 dark:text-gray-300">
                            {{ $item['category'] }}
                        </div>

                        <div class="flex-1">
                            <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                <div
                                    class="h-full rounded-full transition-all duration-700 "
                                    style="width: {{ $item['percentage'] }}% ; background-color: {{ $item['color'] }}"
                                ></div>
                            </div>
                        </div>

                        <div class="w-28 text-right">
                            <span class="text-xs font-medium text-gray-900 dark:text-white">
                                {{ number_format($item['gb'], 2) }} GB
                            </span>
                            <span class="text-xs text-gray-500 dark:text-gray-400 ml-1">
                                ({{ $item['percentage'] }}%)
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>


        @endif
    </div>
</div>
