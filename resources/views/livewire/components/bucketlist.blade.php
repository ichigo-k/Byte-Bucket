<div>
    <h2 class="text-lg font-semibold text-white mb-4">
        Your Buckets
    </h2>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <!-- Search Input -->
        <div class="relative md:max-w-xs w-full">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input
                type="search"
                placeholder="Search buckets..."
                wire:model.live="search"
                class="w-full pl-9 pr-3 py-1.5 bg-light-black border border-white/15 rounded-lg shadow-sm text-gray-300 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-600 transition"
            />
        </div>

        <!-- New Bucket Button -->
        <a href="{{ route('create.bucket') }}"
           class="px-3.5 py-1.5 bg-primary border-2 border-secondary  text-white font-medium rounded-lg shadow-sm hover:shadow transition flex items-center gap-2 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            New Bucket
        </a>
    </div>

    <!-- Buckets Grid -->
    @if($buckets->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($buckets as $bucket)
                <a href="{{ route('dashboard') }}"
                   class="group block relative bg-light-black/50 border border-white/10 rounded-xl p-6 overflow-hidden
                      hover:border-primary/50 hover:bg-light-black/70 transition-all duration-500
                      shadow-md hover:shadow-2xl hover:shadow-primary/10 transform hover:-translate-y-2">

                    <!-- Subtle hover glow overlay -->
                    <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                    <div class="relative z-10">
                        <h3 class="text-white font-semibold text-lg mb-3">
                            {{ $bucket->name }}
                        </h3>

                        <div class="space-y-2 text-sm text-gray-400">
                            <div class="flex items-center">
                            <span class="px-2 py-0.5 rounded text-xs capitalize
                                @if($bucket->type === 'standard') bg-blue-500/20 text-blue-300
                                @elseif($bucket->type === 'archival') bg-amber-500/20 text-amber-300
                                @else bg-purple-500/20 text-purple-300 @endif">
                                {{ str_replace('_', ' ', $bucket->type) }}
                            </span>
                            </div>

                            <div>
                                <span class="font-medium">Physical Name:</span>
                                <code class="ml-2 text-gray-300 text-xs bg-black/30 px-2 py-0.5 rounded">
                                    {{ $bucket->physical_bucket_name }}
                                </code>
                            </div>

                            <div>
                                <span class="font-medium">Size:</span>
                                <code class="ml-2 text-gray-300 text-xs bg-black/30 px-2 py-0.5 rounded">
                                    {{ $bucket->sizeInGb() }} GB
                                </code>
                            </div>

                            <div class="text-xs text-gray-500 pt-2">
                                Created {{ $bucket->created_at->diffForHumans() }}
                            </div>
                        </div>

                        <!-- Arrow Indicator - slides in from right on hover -->
                        <div class="mt-4 text-right opacity-0 group-hover:opacity-100 transform translate-x-4 group-hover:translate-x-0 transition-all duration-500">
                            <svg class="w-5 h-5 text-primary inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-center py-16">
            <div class="bg-gray-800/30 border border-dashed border-gray-600 rounded-xl p-10 max-w-md mx-auto">
                <p class="text-gray-400 text-lg mb-4">
                    @if($search)
                        No buckets found matching "<span class="text-white">{{ $search }}</span>".
                    @else
                        You don't have any buckets yet.
                    @endif
                </p>
                <a href="{{ route('create.bucket') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:shadow transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create Your First Bucket
                </a>
            </div>
        </div>
    @endif


</div>
