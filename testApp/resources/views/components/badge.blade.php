@props(
    [
        'color'
    ]
)

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-'.$color.'-500 text-white']) }}>
    {{ $slot }}
</span>