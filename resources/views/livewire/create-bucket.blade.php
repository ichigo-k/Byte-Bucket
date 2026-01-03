<div class="max-w-4xl mx-auto py-8 px-6">
    <h1 class="text-2xl font-bold text-white mb-2">Create a new bucket</h1>
    <p class="text-gray-400 mb-8">
        Buckets store your objects (files) and control access. A bucket name must be globally unique across all users.
    </p>

    <form wire:submit="createBucket" class="flex gap-1">

        <div class="relative flex-shrink-0">
            <div class="absolute left-[13px] top-8 bottom-12 w-[1px] bg-gray-500"></div>

            <ol class="relative ">
                <li class="flex items-center">
                    <div class="flex items-center justify-center w-7 h-7 rounded-full bg-gray-500 text-white text-sm font-semibold z-10">
                        1
                    </div>
                    <span class="ml-4 text-base font-semibold text-white">General</span>
                </li>

                <li class="flex items-center mt-[9rem]">
                    <div class="flex items-center justify-center w-7 h-7 rounded-full bg-gray-500 text-gray-400 text-sm font-medium z-10">
                        2
                    </div>
                    <span class="ml-4 text-base font-medium text-white">Configuration</span>
                </li>

            </ol>
        </div>

        <div class="flex-1 space-y-10 mt-10 ">
            <section class="-ml-[7rem]">
                <div class=" py-5 space-y-5  rounded-lg">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">
                            Bucket name <span class="text-red-500">*</span>
                        </label>
                        <div class="flex rounded-md shadow-sm">
              <span class="inline-flex items-center px-3 bg-light-black border border-r-0 border-gray-700 text-gray-400 rounded-l-md text-sm capitalize">
                {{ Auth::user()->username ?? Auth::user()->first_name  }}
              </span>
                            <input
                                    type="text"
                                    wire:model.live="name"
                                    class="max-w-sm bg-light-black border border-gray-700 rounded-r-md focus:ring-blue-500 focus:border-blue-500 text-white px-3 py-1.5 text-sm"
                                    placeholder="my-awesome-bucket"
                                    required
                            />
                        </div>

                        @if($errors->has('name'))
                            <p class="mt-1.5 text-sm text-red-400">{{ $errors->first('name') }}</p>
                        @else
                            <p class="mt-1.5 text-sm text-gray-400">
                                Great bucket names are short and memorable.
                                @if($name && ! $errors->has('name'))
                                    <span class="text-green-400">
                    How about <strong>{{ Str::kebab($name) }}</strong>?
                  </span>
                                @endif
                            </p>
                        @endif
                    </div>
                </div>
            </section>

            <section class="-ml-[7rem]">
                <div class="py-5 space-y-5  rounded-lg">
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-300 mb-1.5">
                            Storage class <span class="text-red-500">*</span>
                        </label>
                        <p class="text-sm text-gray-400 mb-3">
                            Choose the default storage type for objects in this bucket.
                        </p>
                        <select
                                id="type"
                                wire:model="type"
                                class="w-full max-w-sm bg-light-black border border-gray-700 rounded-md focus:border-blue-500 focus:ring-blue-500 text-white px-3 py-1.5 text-sm"
                        >
                            <option value="standard">Standard — Frequently accessed data</option>
                            <option value="archival">Archival — Long-term backup (lower cost)</option>
                            <option value="deep_archive">Deep Archive — Rarely accessed (lowest cost)</option>
                        </select>
                    </div>
                </div>
            </section>

            <div class="-ml-[7rem] " >
                <button
                        type="submit"
                        class="px-5 py-2 bg-green-600 hover:bg-green-500 text-white font-medium rounded-md transition text-sm"
                        wire:loading.attr="disabled"
                >
                    <span wire:loading.remove>Create bucket</span>
                    <span wire:loading>Creating bucket...</span>
                </button>
            </div>
        </div>
    </form>
</div>
