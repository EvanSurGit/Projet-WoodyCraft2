<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Afficher une categorie')
        </h2>
    </x-slot>

    <x-puzzles-card>
        <h3 class="font-semibold text-xl text-gray-800">@lang('Nom')</h3>
        <p>{{ $categorie->nom }}</p>

    </x-puzzles-card>
</x-app-layout>