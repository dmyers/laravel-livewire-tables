@aware(['component'])
@props(['row', 'rowIndex'])

@php
    $attributes = $attributes->merge(['wire:key' => 'row-'.$rowIndex.'-'.$component->getId()]);
    $customAttributes = $this->getTrAttributes($row, $rowIndex);
@endphp

<tr
    wire:loading.class.delay="opacity-50 dark:bg-gray-900 dark:opacity-60"
        id="{{ 'row-'.$row->{$this->getPrimaryKey()} }}"
        x-data="reorderFunction"
        draggable="true"
        x-on:dragstart.self="dragStart(event)"
        x-on:drop="dropEvent"
        x-on:drop.prevent="dropPreventEvent"
        x-on:dragover.prevent="removing = true"
        x-on:dragleave.prevent="removing = false"

    @class([
        'bg-white dark:bg-gray-700 dark:text-white' => ($component->isTailwind() &&
        ($customAttributes['default'] ?? true) && $rowIndex % 2 === 0),
        'bg-gray-50 dark:bg-gray-800 dark:text-white' => ($component->isTailwind() && ($customAttributes['default'] ?? true) && $rowIndex % 2 !== 0),
        'cursor-pointer' => ($component->isTailwind() && $component->hasTableRowUrl()),
        'bg-white ' => ($component->isBootstrap() && $rowIndex % 2 === 0),
        'bg-secondary' => ($component->isBootstrap() && $rowIndex % 2 !== 0),
    ])
>
    {{ $slot }}
</tr>
