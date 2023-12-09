@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 shadow'])

@php
switch ($align) {
    case 'left':
        $alignmentClasses = 'dropdown-menu-start';
        break;
    case 'top':
        $alignmentClasses = 'dropdown-menu-start';
        break;
    case 'right':
    default:
        $alignmentClasses = 'dropdown-menu-end';
        break;
}

switch ($width) {
    case '48':
        $width = 'w-48';
        break;
}
@endphp

<div class="dropdown" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <button class="btn" @click="open = ! open">
        {{ $trigger }}
    </button>

    <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="dropdown-menu {{ $alignmentClasses }}"
            style="display: none;"
            @click="open = false">
        <div class="dropdown-menu-content {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
