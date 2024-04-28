



<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Your Interests') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Give us some of your interests.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('save_categories') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div style="display: flex; justify-content: space-between;">
            
            <ul class="list-group list-group-light">
                <x-input-label for="name" :value="__('Categories')" />
                @foreach ($categories as $category)
                    <div>
                        <label>
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </div>
                @endforeach
            </ul>

            
            <ul class="list-group list-group-light">
                <x-input-label for="name" :value="__('Cities')" />
                @foreach (DB::table('cities')->get() as $city)
                    <div>
                        <label>
                            <input type="checkbox" name="cities[]" value="{{ $city->id }}">
                            {{ $city->name }}
                            
                        </label>
                    </div>
                @endforeach
            </ul>
        </div>
        

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
