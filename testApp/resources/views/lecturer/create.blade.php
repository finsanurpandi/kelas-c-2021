<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        @if(request()->routeIs('lecturer.create'))
            {{ __('Tambah Lecturer') }}
        @else
            {{ __('Edit Lecturer') }}
        @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                @if(request()->routeIs('lecturer.create'))
                    <!-- form data -->
                    <form method="post" action="{{ route('lecturer.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="nidn" :value="__('NIDN')" />
                            <x-text-input id="nidn" name="nidn" type="text" class="mt-1 block w-1/2" autocomplete="nidn" :value="old('nidn')"/>
                            <x-input-error :messages="$errors->get('nidn')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="nama" :value="__('NAMA')" />
                            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-1/2" autocomplete="nama" :value="old('nama')" required/>
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="department" :value="__('DEPARTMENT')" />
                            <x-select-input id="department" name="department_id" class="mt-1 block w-1/2" autocomplete="department_id">
                                @foreach($departments as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </x-select-input>
                            <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
                        </div>
                        <x-primary-button>CREATE</x-primary-button>
                    </form>
                @else
                    <form method="post" action="{{ route('lecturer.update', $lecturer->nidn) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PATCH')
                        <div>
                            <x-input-label for="nidn" :value="__('NIDN')" />
                            <x-text-input id="nidn" name="nidn" type="text" class="mt-1 block w-1/2" autocomplete="nidn" :value="old('nidn', $lecturer->nidn)"/>
                            <x-input-error :messages="$errors->get('nidn')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="nama" :value="__('NAMA')" />
                            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-1/2" autocomplete="nama" :value="old('nama', $lecturer->nama)" required/>
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="department" :value="__('DEPARTMENT')" />
                            <x-select-input id="department" name="department_id" class="mt-1 block w-1/2" autocomplete="department_id">
                                @foreach($departments as $key => $value)
                                    <option value="{{ $key }}" @if(Request::old('department_id', $lecturer->department_id) == $key) selected="selected" @endif>{{ $value }}</option>
                                @endforeach
                            </x-select-input>
                            <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
                        </div>
                        <x-primary-button>UPDATE</x-primary-button>
                    </form>
                @endif
                </div> 
            </div>
        </div>
    </div>
</x-app-layout>
