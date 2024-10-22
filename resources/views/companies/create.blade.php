<x-app-layout>
    <body>
        <div class="card">
            <h1 class="text-3xl font-bold mb-4">Crear nueva compañía</h1>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('companies.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre de la compañía:</label>
                    <input type="text" name="name" id="name" class="border border-gray-300 rounded-md w-full p-2" required>
                </div>

                <div class="mb-4">
                    <label for="monthly_earnings" class="block text-sm font-medium text-gray-700">Ganancias mensuales:</label>
                    <input type="number" name="monthly_earnings" id="monthly_earnings" class="border border-gray-300 rounded-md w-full p-2" required>
                </div>

                <div class="mb-4">
                    <label for="hours_worked" class="block text-sm font-medium text-gray-700">Horas trabajadas:</label>
                    <input type="number" name="hours_worked" id="hours_worked" class="border border-gray-300 rounded-md w-full p-2" required>
                </div>

                <div class="mb-4">
                    <label for="user_id" class="block text-sm font-medium text-gray-700">ID del usuario:</label>
                    <input type="number" name="user_id" id="user_id" class="border border-gray-300 rounded-md w-full p-2" required>
                </div>

                <button type="submit" class="bg-blue-500 text-white p-2 rounded">Crear compañía</button>
            </form>
        </div>
    </body>
</x-app-layout>
