<x-layout>
    @if (!session()->has('user'))
        Vous devez être connecté pour accéder à cette page.
    @else
        <x-page-title>Plongées de
            {{ session('user')->US_FIRST_NAME . ' ' . session('user')->US_NAME }} | {{ $usersCount }} plongées restantes</x-page-title>

        <p style="font-size: 35px"> A venir </p>
        <hr style="height: 3px;background-color: black;margin-bottom: 30px;margin-top: 5px; width : 20%;">
        <table style="text-align: left; width: 100%; margin-bottom: 50px;">
            <thead class="text-xs text-gray-700 bg-gray-50" style="border-bottom: 1px solid black; font-size: 15px;">
                <tr>
                    <th scope="col" class="px-12 py-3">Date</th>
                    <th scope="col" class="px-12 py-3">Heure</th>
                    <th scope="col" class="px-12 py-3">Rôle</th>
                    <th scope="col" class="px-12 py-3">Lieu</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datesA as $dateA)
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-12 py-4">{{ $dateA->DS_DATE }}</td>
                        @if($dateA->CAR_SCHEDULE == 'Matin')
                            <td class="px-12 py-4">9:00 - 12:00</td>
                        @elseif($dateA->CAR_SCHEDULE == 'Apres-midi')
                            <td class="px-12 py-4">13:00 - 17:00</td>
                        @elseif($dateA->CAR_SCHEDULE == 'Soir')
                            <td class="px-12 py-4">18:00 - 21:00</td>
                        @endif
                        <td class="px-12 py-4">{{ $dateA->ROL_LABEL }}</td>
                        <td class="px-12 py-4">{{ $dateA->DL_NAME }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        

        <p style="font-size: 35px"> Ayant eu lieu </p>
        <hr style="height: 3px;background-color: black;margin-bottom: 30px;margin-top: 5px; width : 20%">
        <table style="text-align: left; width: 100%;  margin-bottom: 50px;">
            <thead class="text-xs text-gray-700 bg-gray-50" style="border-bottom: 1px solid black; font-size: 15px;">
                <tr>
                    <th scope="col" class="px-12 py-3">Date</th>
                    <th scope="col" class="px-12 py-3">Heure</th>
                    <th scope="col" class="px-12 py-3">Rôle</th>
                    <th scope="col" class="px-12 py-3">Lieu</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datesB as $dateB)
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-12 py-4">{{ $dateB->DS_DATE }}</td>
                        @if($dateB->CAR_SCHEDULE == 'Matin')
                            <td class="px-12 py-4">9:00 - 12:00</td>
                        @elseif($dateB->CAR_SCHEDULE == 'Apres-midi')
                            <td class="px-12 py-4">13:00 - 17:00</td>
                        @elseif($dateB->CAR_SCHEDULE == 'Soir')
                            <td class="px-12 py-4">18:00 - 21:00</td>
                        @endif
                        <td class="px-12 py-4">{{ $dateB->ROL_LABEL }}</td>
                        <td class="px-12 py-4">{{ $dateB->DL_NAME }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-layout>
