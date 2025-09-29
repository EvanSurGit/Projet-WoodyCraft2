<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Liste des Categories')
        </h2>
    </x-slot>

    <div class="container flex justify-center mx-auto">
        <div class="flex flex-col">
            <div class="w-full">
                <div class="border-b border-gray-200 shadow pt-6">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-2 py-2 text-xs text-gray-500">#</th>
                                <th class="px-2 py-2 text-xs text-gray-500">Nom</th>
                                <th class="px-2 py-2 text-xs text-gray-500">Actions</th> <!-- Nouvelle colonne -->
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($categories as $categorie)
                                <tr class="whitespace-nowrap">
                                    <td class="px-4 py-4 text-sm text-gray-500">{{ $categorie->id }}</td>
                                    <td class="px-4 py-4">{{ $categorie->nom }}</td>
                                    <td class="px-4 py-4">
                                        <x-link-button href="{{ route('puzzles.byCategorie', $categorie->id) }}">
                                            @lang('Puzzle de la meme categorie')
                                        </x-link-button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
