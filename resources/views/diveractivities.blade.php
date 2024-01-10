<x-layout>
    @if(!session()->has('user'))
            Vous devez être connecté pour accéder à cette page.
    @else
    <x-page-title>Historique des plongées de {{ session('user')->US_FIRST_NAME . " " . session('user')->US_NAME }}</x-page-title>
    <div class="shadow-md max-w-full w-1/3 rounded-lg overflow-hidden border-2 mx-auto">
        <table class="text-sm text-left text-gray-500 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Nombre de plongées</th>
            </tr>
            </thead>
            <tbody>
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <td class="px-6 py-4">{{ $usersCount }}</td>
                </tr>
            </tbody>
        </table>        
    </div>

    <div class="mt-10 shadow-md max-w-full w-1/3 rounded-lg overflow-hidden border-2 mx-auto">
        <table class="text-sm text-left text-gray-500 w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Lieu</th>
                <th scope="col" class="px-6 py-3">Date</th>
                <th scope="col" class="px-6 py-3">Rôle</th>
            </tr>
            </thead>
            <tbody>
                @foreach($dates as $date)
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <td class="px-6 py-4">{{ $date->DL_NAME }}</td>
                    <td class="px-6 py-4">{{ $date->DS_DATE }}</td>
                    <td class="px-6 py-4">{{ $date->ROL_LABEL }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</x-layout>