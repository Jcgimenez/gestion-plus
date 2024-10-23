<x-app-layout>
    <body>
        <div class="card">
            <span class="text-3xl font-bold">{{$user->name}}</span>

            <div class="flex justify-start mb-4">
                <a href="{{ route('companies.create') }}" class="bg-green-500 text-white px-4 py-2 rounded flex space-x-2">
                    <span>New company</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </a>
            </div>

            <div class="chart-container">
                @foreach($user->companies as $company)
                <div class="bank-card relative">
                    <div class="bank-title flex-col justify-start items-center">
                        <!-- Nombre de la compañía -->
                        <div>
                            <span class="bank-name">Name: {{ $company->name }}</span>
                        </div>
                        <div>
                            <span class="bank-name">Earnings: ${{ $company->monthly_earnings }}</span>
                        </div>
                        <span class="bank-name">Hours: {{ $company->hours_worked }}hs</span>

                        <div class="absolute -top-5 -right-4 flex">
                            <!-- Botón para abrir el modal de edición (badge) -->
                            <button onclick="openModal({{ $company->id }})" class=" bg-gray-100 text-gray-500 font-bold p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path d="M16.864 2.5a1.5 1.5 0 0 1 2.122 0l2.514 2.514a1.5 1.5 0 0 1 0 2.122l-12.12 12.12a1.5 1.5 0 0 1-.535.336l-5 1.667a.75.75 0 0 1-.95-.95l1.667-5a1.5 1.5 0 0 1 .336-.535l12.12-12.12ZM15.5 6.621 5.12 17H5v-.12L15.379 6.5 15.5 6.621ZM18.5 3.621l-1.621 1.62 2.5 2.5 1.621-1.621-2.5-2.5Z"/>
                                </svg>
                            </button>

                            <!-- Botón para eliminar el banco -->
                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-500 font-bold p-2 rounded-full bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                      <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                    <!-- Modal para editar la compañía -->
                    <div id="modal-{{ $company->id }}" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
                        <!-- Overlay oscuro -->
                        <div class="modal-overlay bg-black opacity-50 fixed inset-0"></div>

                        <!-- Contenido del modal -->
                        <div class="flex items-center justify-center min-h-screen">
                            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full relative z-20">
                                <h2 class="text-xl font-bold mb-4">Edit Company</h2>

                                <form action="{{ route('companies.update', $company->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-4">
                                        <label for="name-{{ $company->id }}" class="block text-sm font-medium text-gray-700">Name</label>
                                        <input type="text" name="name" id="name-{{ $company->id }}" value="{{ $company->name }}" class="mt-1 block w-full">
                                    </div>

                                    <div class="mb-4">
                                        <label for="monthly_earnings-{{ $company->id }}" class="block text-sm font-medium text-gray-700">Monthly Earnings</label>
                                        <input type="text" name="monthly_earnings" id="monthly_earnings-{{ $company->id }}" value="{{ $company->monthly_earnings }}" class="mt-1 block w-full" oninput="validateNumber(this)">
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="hours_worked-{{ $company->id }}" class="block text-sm font-medium text-gray-700">Hours Worked</label>
                                        <input type="text" name="hours_worked" id="hours_worked-{{ $company->id }}" value="{{ $company->hours_worked }}" class="mt-1 block w-full" oninput="validateNumber(this)">
                                    </div>

                                    <div class="flex justify-end">
                                        <button type="button" onclick="closeModal({{ $company->id }})" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel</button>
                                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Scripts para abrir y cerrar el modal -->
        <script>
            function openModal(companyId) {
                document.getElementById('modal-' + companyId).classList.remove('hidden');
            }

            function closeModal(companyId) {
                document.getElementById('modal-' + companyId).classList.add('hidden');
            }

            function validateNumber(input) {
                input.value = input.value.replace(/[^0-9]/g, '');
            }
        </script>
    </body>
</x-app-layout>
