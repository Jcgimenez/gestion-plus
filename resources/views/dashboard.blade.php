<x-app-layout>
    <x-slot name="header">
        <h2 class="flex justify-center font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <pre class="bg-gray-100 p-4 rounded w-full flex">
            {{ $user }}
        </pre>
    </div>
</x-app-layout>
