@php
    $isContained = $isContained();
    $gridDefault = $getGridColumns('default') ?? 1;
    $gridSm = $getGridColumns('sm') ?? $gridDefault;
    $gridMd = $getGridColumns('md') ?? $gridSm;
    $gridLg = $getGridColumns('lg') ?? $gridMd;
    $gridXl = $getGridColumns('xl') ?? $gridLg;
    $grid2xl = $getGridColumns('2xl') ?? $gridXl;
    $childContainers = $getChildComponentContainers();
@endphp

<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div
        {{
            $attributes
                ->merge([
                    'id' => $getId(),
                ], escape: false)
                ->merge($getExtraAttributes(), escape: false)
                ->class([
                    'fi-in-repeatable',
                    'fi-contained' => $isContained,
                ])
        }}
    >
        @if (count($childComponentContainers = $getChildComponentContainers()))
            <ol class="relative border-l border-gray-200 dark:border-gray-700">
                <div class="flex flex-col gap-2
                {{ 'columns-' . $gridDefault }}
                {{ 'sm:columns-' . $gridSm }}
                {{ 'md:columns-' . $gridMd }}
                {{ 'lg:columns-' . $gridLg }}
                {{ 'xl:columns-' . $gridXl }}
                {{ '2xl:columns-' . $grid2xl }}">
                    @foreach ($childComponentContainers as $container)
                        <li class="mb-4 ml-6 fi-in-repeatable-item block @if($contained) rounded-xl bg-white p-4 shadow-sm ring-gray-950/5 dark:bg-white/5 dark:ring-white/10 @endif">
                            {{ $container }}
                        </li>
                    @endforeach
                </div>
            </ol>
        @elseif (($placeholder = $getPlaceholder()) !== null)
            <div class="px-4 py-6 text-center text-sm text-gray-500 dark:text-gray-400">
                {!! $placeholder !!}
            </div>
        @endif
    </div>
</x-dynamic-component>
