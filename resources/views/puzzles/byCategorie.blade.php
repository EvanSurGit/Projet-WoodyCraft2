<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Puzzles dans la catégorie : {{ $categorie->nom }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($puzzles as $puzzle)
            <div class="border p-4 rounded shadow">
                <h3 class="text-lg font-bold">{{ $puzzle->nom }}</h3>
                <p>Prix : {{ $puzzle->prix }} €</p>
                <p>Note : {{ $puzzle->note }}/5</p>
            </div>
        @empty
            <p>Aucun puzzle dans cette catégorie.</p>
        @endforelse
    </div>
</x-app-layout>

