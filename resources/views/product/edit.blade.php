<x-guest-layout>
    <form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $product->name }}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="form-group">
            <x-input-label for="exampleFormControlSelect1" :value="__('City')" />
                <select class="form-control" name="ville" id="exampleFormControlSelect1" value="{{$product->origin}}" style="width:100%; border-radius: 5px;">
                    <option value="Agadir">Agadir</option>
                    <option value="Benimellal">Benimellal</option>
                    <option value="Casa">Casa</option>
                    <option value="Essaouira">Essaouira</option>
                    <option value="Fes">Fes</option>
                    <option value="Jedida">Jedida</option>
                    <option value="Ifran">Ifran</option>
                    <option value="Khnifra">Khnifra</option>
                    <option value="Meknas">Meknas</option>
                    <option value="Merakch">Merakch</option>
                    <option value="Rabat">Rabat</option>
                    <option value="Sela">Sela</option>
                </select>
          </div>
        

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Price')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="number"
                            name="price"
                            value="{{ $product->price }}"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Pics')" />

            <x-text-input id="pic" class="block mt-1 w-full"
                            type="file"
                            name="pic"
                            
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('pic')" class="mt-2" />
        </div>


        <div class="form-group">
            <x-input-label for="exampleFormControlSelect2" :value="__('City')" />
                <select class="form-control" name="cat" id="exampleFormControlSelect2" style="width:100%; border-radius: 5px;">
                    <option value="Electronic">Electronic</option>
                    <option value="Cloths">Cloths</option>
                    <option value="Accessories">Accessories</option>
                    <option value="House">House</option>
                    <option value="Sports">Sports</option>
                    <option value="Computers">Computers</option>
                    <option value="Arts">Arts</option>
                    <option value="Baby">Baby</option>
                </select>
          </div>

        <div class="mt-4">
            <x-input-label for="txte" :value="__('Description')" />

            <textarea id="w3review" name="desc" rows="4" cols="40" style="margin: 10px">
                {{ $product->desc }}
                </textarea>

            <x-input-error :messages="$errors->get('pic')" class="mt-2" />
        </div>

        

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('dashboard') }}">
                {{ __('Go Back') }}
            </a>

            <x-primary-button class="ml-4" style="background-color:aliceblue;">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>




