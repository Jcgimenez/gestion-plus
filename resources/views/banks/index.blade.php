<x-app-layout>
    <body>
        <div class="card">
            <span class="text-3xl font-bold">{{$user->name}}</span>

            <div class="flex justify-start mb-4">
                <!-- Botón para crear un nuevo banco -->
                <a href="{{ route('banks.create') }}" class="bg-green-500 text-white px-4 py-2 rounded flex space-x-2">
                    <span>New bank</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </a>
            </div>

            <div class="chart-container">
                @foreach($user->banks as $bank)
                    <div class="bank-card">
                        <div class="bank-title flex space-x-2 justify-center items-center">
                            <!-- Nombre del banco editable -->
                            <span class="bank-name" ondblclick="enableEdit(this, {{ $bank->id }})">{{ $bank->name }}</span>
                            <input type="text" class="bank-name-input hidden w-full max-w-full" id="bank-name-{{ $bank->id }}" value="{{ $bank->name }}" onblur="saveBankName(this, {{ $bank->id }})" onkeydown="checkEnter(event, {{ $bank->id }})">

                            <!-- Botón para eliminar el banco -->
                            <form action="{{ route('banks.destroy', $bank->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this bank?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-500 font-bold p-2 rounded-full flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                      <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>

                            <!-- Formulario para actualizar el banco -->
                            <form action="{{ route('banks.update', $bank->id) }}" method="POST" id="form-bank-update-{{ $bank->id }}" class="hidden">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="name" id="input-bank-name-{{ $bank->id }}" value="{{ $bank->name }}">
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Script para habilitar la edición y guardar los cambios -->
        <script>
            function enableEdit(element, bankId) {
                const spanElement = element.tagName === 'SPAN' ? element : document.querySelector(`#bank-name-${bankId}`);
                const inputElement = document.querySelector(`#bank-name-${bankId}`);

                spanElement.classList.add('hidden');
                inputElement.classList.remove('hidden');
                inputElement.focus();
            }

            function saveBankName(input, bankId) {
                const bankName = input.value;
                const spanElement = document.querySelector(`#bank-name-${bankId}`);
                const hiddenInput = document.querySelector(`#input-bank-name-${bankId}`);

                if (bankName !== spanElement.innerText) {
                    input.classList.add('hidden');
                    spanElement.classList.remove('hidden');
                    spanElement.innerText = bankName;

                    hiddenInput.value = bankName;

                    document.querySelector(`#form-bank-update-${bankId}`).submit();
                } else {
                    input.classList.add('hidden');
                    spanElement.classList.remove('hidden');
                }
            }

            function checkEnter(event, bankId) {
                if (event.key === 'Enter') {
                    saveBankName(event.target, bankId);
                }
            }
        </script>
    </body>
</x-app-layout>
