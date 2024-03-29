<x-layout>
    <x-page-title>Plongées réalisées</x-page-title>


    <form action="?{afterthe}&{beforethe}">
        <label for="afterthe">Apres le :</label>
        <input type="date" name="afterthe">
        <label for="before the">et avant le :</label>
        <input type="date" name="beforethe">
        <x-button>Rechercher</x-button>
    </form>


    <div class="shadow-md max-w-full w-2/3 content-between rounded-lg overflow-hidden border-2 mx-auto">        <table class="text-sm text-left text-gray-500 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Nom</th>
                <th scope="col" class="px-6 py-3">Prénom</th>
                <th scope="col" class="px-6 py-3">Nombre de plongées réalisées</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($datas as $data)
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <td class="px-6 py-4">{{ $data->US_NAME }}</td>
                    <td class="px-6 py-4">{{ $data->US_FIRST_NAME }}</td>
                    <td class="px-6 py-4">{{ $data->aggregate }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-layout>