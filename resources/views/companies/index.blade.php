<x-app-layout>
    <body>
        <div class="card">
            <span class="text-3xl font-bold">{{$user->name}}</span>

            <div class="flex justify-start mb-4">
                <!-- Botón para crear una nueva compañía -->
                <a href="{{ route('companies.create') }}" class="bg-green-500 text-white px-4 py-2 rounded flex space-x-2">
                    <span>New company</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </a>
            </div>

            <div class="chart-container">
                @foreach($user->companies as $company)
                    <div class="company-card">
                        <div class="company-title flex space-x-2 justify-center items-center">
                            <!-- Nombre de la compañía editable -->
                            <span class="company-name" ondblclick="enableEdit(this, {{ $company->id }})">{{ $company->name }}</span>
                            <input type="text" class="company-name-input hidden w-full max-w-full" id="company-name-{{ $company->id }}" value="{{ $company->name }}" onblur="saveCompanyName(this, {{ $company->id }})" onkeydown="checkEnter(event, {{ $company->id }})">

                            <!-- Botón para eliminar la compañía -->
                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this company?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-500 font-bold p-2 rounded-full flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                      <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>

                            <!-- Formulario para actualizar la compañía -->
                            <form action="{{ route('companies.update', $company->id) }}" method="POST" id="form-company-update-{{ $company->id }}" class="hidden">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="name" id="input-company-name-{{ $company->id }}" value="{{ $company->name }}">
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Script para habilitar la edición y guardar los cambios -->
        <script>
            function enableEdit(element, companyId) {
                const spanElement = element.tagName === 'SPAN' ? element : document.querySelector(`#company-name-${companyId}`);
                const inputElement = document.querySelector(`#company-name-${companyId}`);

                spanElement.classList.add('hidden');
                inputElement.classList.remove('hidden');
                inputElement.focus();
            }

            function saveCompanyName(input, companyId) {
                const companyName = input.value;
                const spanElement = document.querySelector(`#company-name-${companyId}`);
                const hiddenInput = document.querySelector(`#input-company-name-${companyId}`);

                if (companyName !== spanElement.innerText) {
                    input.classList.add('hidden');
                    spanElement.classList.remove('hidden');
                    spanElement.innerText = companyName;

                    hiddenInput.value = companyName;

                    document.querySelector(`#form-company-update-${companyId}`).submit();
                } else {
                    input.classList.add('hidden');
                    spanElement.classList.remove('hidden');
                }
            }

            function checkEnter(event, companyId) {
                if (event.key === 'Enter') {
                    saveCompanyName(event.target, companyId);
                }
            }
        </script>
    </body>
</x-app-layout>
