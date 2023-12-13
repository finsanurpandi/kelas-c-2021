<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lecturer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  {{ $user->unreadNotifications}}
                  <x-primary-button tag="a" :href="route('lecturer.create')">
                    Tambah Data
                  </x-primary-button>
                  <br/><br/>
                    <!-- table lecturer -->
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                          <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                              <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                  <tr>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">#</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">NIDN</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">NAMA</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">DEPARTMENT</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">AKSI</th>
                                  </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @php $no=1; @endphp
                                @foreach($lecturers as $lecturer) 
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $no++ }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $lecturer->nidn }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $lecturer->nama }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $lecturer->department->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                          <!-- isi untuk tombol edit dan delete -->
                                          <x-primary-button tag="a" :href="route('lecturer.students', $lecturer->nidn)">
                                            Mahasiswa
                                          </x-primary-button>
                                          <x-primary-button tag="a" :href="route('lecturer.edit', $lecturer->nidn)">
                                            Edit Data
                                          </x-primary-button>
                                          <x-danger-button
                                              x-data=""
                                              x-on:click.prevent="$dispatch('open-modal', 'confirm-lecturer-deletion')"
                                              x-on:click="$dispatch('set-action', '{{ route('lecturer.destroy', $lecturer->nidn) }}')"
                                          >{{ __('Delete Data') }}</x-danger-button>
                                        </td>
                                    </tr>
                                @endforeach
                      
                                </tbody>
                              </table>

                              <x-modal name="confirm-lecturer-deletion" focusable>
                                <form method="post" x-bind:action="action" class="p-6">
                                    @csrf
                                    @method('delete')
                        
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Apakah anda yakin akan menghapus data lecturer?') }}
                                    </h2>
                        
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('Data yang terhapus tidak dapat dikembalikan...') }}
                                    </p>
                        
                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            {{ __('Cancel') }}
                                        </x-secondary-button>
                        
                                        <x-danger-button class="ml-3">
                                            {{ __('Delete Data') }}
                                        </x-danger-button>
                                    </div>
                                </form>
                            </x-modal>
                            </div>
                          </div>
                        </div>
                      </div>

                    <!-- end of table -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
