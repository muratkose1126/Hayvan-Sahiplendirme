@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Sayfalama Navigasyonu" class="flex items-center justify-between my-8">
            <div class="flex justify-between flex-1 sm:hidden">
                <span>
                    @if ($paginator->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-neutral-text dark:text-neutral-text-dark bg-surface dark:bg-surface-dark rounded-md shadow-sm transition duration-150 ease-in-out">
                            {!! __('pagination.previous') !!}
                        </span>
                    @else
                        <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-btn-primary dark:text-btn-primary-dark bg-surface dark:bg-surface-dark rounded-md shadow-sm hover:bg-btn-primary-hover dark:hover:bg-btn-primary-hover-dark hover:text-btn-primary-text dark:hover:text-btn-primary-text-dark focus:outline-none focus:ring-2 focus:ring-btn-primary-focus dark:focus:ring-btn-primary-focus-dark focus:ring-offset-2 transition duration-150 ease-in-out">
                            {!! __('pagination.previous') !!}
                        </button>
                    @endif
                </span>

                <span>
                    @if ($paginator->hasMorePages())
                        <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-btn-primary dark:text-btn-primary-dark bg-surface dark:bg-surface-dark rounded-md shadow-sm hover:bg-btn-primary-hover dark:hover:bg-btn-primary-hover-dark hover:text-btn-primary-text dark:hover:text-btn-primary-text-dark focus:outline-none focus:ring-2 focus:ring-btn-primary-focus dark:focus:ring-btn-primary-focus-dark focus:ring-offset-2 transition duration-150 ease-in-out">
                            {!! __('pagination.next') !!}
                        </button>
                    @else
                        <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-neutral-text dark:text-neutral-text-dark bg-surface dark:bg-surface-dark rounded-md shadow-sm transition duration-150 ease-in-out">
                            {!! __('pagination.next') !!}
                        </span>
                    @endif
                </span>
            </div>

            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-neutral-text dark:text-neutral-text-dark leading-5">
                        <span>{!! __('Showing') !!}</span>
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        <span>{!! __('to') !!}</span>
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                        <span>{!! __('of') !!}</span>
                        <span class="font-medium">{{ $paginator->total() }}</span>
                        <span>{!! __('results') !!}</span>
                    </p>
                </div>

                <div>
                    <span class="relative z-0 inline-flex rounded-md shadow-sm">
                        {{-- Previous Page Link --}}
                        @if ($paginator->onFirstPage())
                            <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-neutral-text dark:text-neutral-text-dark bg-surface dark:bg-surface-dark rounded-l-md leading-5 transition duration-150 ease-in-out">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                </span>
                            </span>
                        @else
                            <button wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" rel="prev" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-btn-primary dark:text-btn-primary-dark bg-surface dark:bg-surface-dark rounded-l-md leading-5 hover:bg-btn-primary-hover dark:hover:bg-btn-primary-hover-dark hover:text-btn-primary-text dark:hover:text-btn-primary-text-dark focus:z-10 focus:outline-none focus:ring-2 focus:ring-btn-primary-focus dark:focus:ring-btn-primary-focus-dark transition duration-150 ease-in-out" aria-label="{{ __('pagination.previous') }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            </button>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <span aria-disabled="true">
                                    <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-neutral-text dark:text-neutral-text-dark bg-surface dark:bg-surface-dark cursor-default leading-5">{{ $element }}</span>
                                </span>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    <span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                                        @if ($page == $paginator->currentPage())
                                            <span aria-current="page">
                                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-btn-primary-text dark:text-btn-primary-text-dark bg-btn-primary dark:bg-btn-primary-dark cursor-default leading-5 transition duration-150 ease-in-out">{{ $page }}</span>
                                            </span>
                                        @else
                                            <button wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-btn-primary dark:text-btn-primary-dark bg-surface dark:bg-surface-dark leading-5 hover:bg-btn-primary-hover dark:hover:bg-btn-primary-hover-dark hover:text-btn-primary-text dark:hover:text-btn-primary-text-dark focus:z-10 focus:outline-none focus:ring-2 focus:ring-btn-primary-focus dark:focus:ring-btn-primary-focus-dark transition duration-150 ease-in-out" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                                {{ $page }}
                                            </button>
                                        @endif
                                    </span>
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($paginator->hasMorePages())
                            <button wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" rel="next" class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-btn-primary dark:text-btn-primary-dark bg-surface dark:bg-surface-dark rounded-r-md leading-5 hover:bg-btn-primary-hover dark:hover:bg-btn-primary-hover-dark hover:text-btn-primary-text dark:hover:text-btn-primary-text-dark focus:z-10 focus:outline-none focus:ring-2 focus:ring-btn-primary-focus dark:focus:ring-btn-primary-focus-dark transition duration-150 ease-in-out" aria-label="{{ __('pagination.next') }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </button>
                        @else
                            <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                                <span class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-neutral-text dark:text-neutral-text-dark bg-surface dark:bg-surface-dark rounded-r-md leading-5 transition duration-150 ease-in-out">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </span>
                            </span>
                        @endif
                    </span>
                </div>
            </div>
        </nav>
    @endif
</div>
