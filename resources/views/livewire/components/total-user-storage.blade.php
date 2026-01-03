<div class=" md:w-2/5 w-full p-5 rounded-xl shadow-sm border bg-light-black border-white/15 ">

    @if($showText)
        <div class="flex justify-between items-end mb-5">
            <div>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">
                    {{ number_format($used, 2) }} GB
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    of {{ number_format($total, 0) }} GB total
                </div>
            </div>
            <div class="text-right">
                <div class="text-2xl font-semibold text-gray-900 dark:text-white">
                    {{ round($percentage) }}%
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400">used</div>
            </div>
        </div>
    @endif

    <div class="relative h-3 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
        @if($isWarning)
            <div class="absolute inset-0 {{ $isDanger ? 'bg-red-100 dark:bg-red-900/20' : 'bg-amber-100 dark:bg-amber-900/20' }}"></div>
        @endif

        <div
            class="absolute inset-y-0 left-0 rounded-full transition-all duration-700 ease-out bg-gradient-to-r
                   {{ $isDanger
                       ? 'from-red-500 to-red-600'
                       : ($isWarning ? 'from-amber-400 to-amber-500' : 'from-green-500 to-green-600') }}"
            style="width: {{ $percentage }}%"
        ></div>

        @if($percentage > 12)
            <div class="absolute inset-y-0 left-1.5 flex items-center text-xs font-medium text-white">
                {{ number_format($used, 1) }} GB
            </div>
        @endif
        @if($percentage < 88)
            <div class="absolute inset-y-0 right-1.5 flex items-center text-xs font-medium text-gray-600 dark:text-gray-300">
                {{ number_format($total - $used, 1) }} GB free
            </div>
        @endif
    </div>

    <div class="mt-3 flex justify-between items-center">
        <div class="text-xs text-gray-600 dark:text-gray-400">
            {{ round($percentage) }}% of your storage used
        </div>
        @if($isWarning)
            <div class="px-3 py-1 rounded-full text-xs font-medium
                        {{ $isDanger
                            ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'
                            : 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' }}">
                {{ $isDanger ? 'Critical – Low on space' : 'Almost full' }}
            </div>
        @endif
    </div>
</div>
