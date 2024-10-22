<x-app-layout>
    <body>
        <div class="card">
            <h1 class="text-3xl font-bold mb-4">Crear nuevo banco</h1>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('banks.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre del banco:</label>
                    <input type="text" name="name" id="name" class="border border-gray-300 rounded-md w-full p-2" required>
                </div>

                <div class="mb-4">
                    <label for="cod_name" class="block text-sm font-medium text-gray-700">Código del banco:</label>
                    <input type="text" name="cod_name" id="cod_name" class="border border-gray-300 rounded-md w-full p-2" required>
                </div>

                <div class="mb-4">
                    <label for="user_id" class="block text-sm font-medium text-gray-700">ID del usuario:</label>
                    <input type="number" name="user_id" id="user_id" class="border border-gray-300 rounded-md w-full p-2" required>
                </div>

                <button type="submit" class="bg-blue-500 text-white p-2 rounded">Crear banco</button>
            </form>
        </div>
    </body>
</x-app-layout>
