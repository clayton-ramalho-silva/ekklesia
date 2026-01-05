@php
    // Verificar se $slot é string e não vazia
    $fieldName = is_string($slot) ? trim($slot) : null;
@endphp

@if($fieldName && $fieldName !== '')
    @error($fieldName)
        <span class="text-danger">{{ $message }}</span>
    @enderror
@endif

{{-- @error($slot)
    <span class="text-danger">{{ $message }}</span>
@enderror --}}