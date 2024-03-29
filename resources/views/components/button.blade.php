<button
    @if (isset($disabledVal) && $disabledVal == "true") disabled @endif
    class="
    m-1 
    @if (isset($color) && $color != '') {{ $color }} 
    @else 
        bg-gray-400 @endif 
    @if (isset($colorHover) && $colorHover != '') {{ $colorHover }} 
    @else hover:bg-gray-500 @endif 
    text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center
    @if (isset($diveId) && $diveId != '') diveDropdownButton @endif
"
    @if (isset($diveId) && $diveId != '') id = "{{ $diveId }}" @endif>
    {{ $slot }}
</button>
