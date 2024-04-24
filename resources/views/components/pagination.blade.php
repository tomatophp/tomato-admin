@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-500 bg-white border border-zinc-200 cursor-default leading-5 rounded-md">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <x-splade-link href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-700 bg-white border border-zinc-200 leading-5 rounded-md hover:text-zinc-500 focus:outline-none focus:ring ring-zinc-300 focus:border-blue-300 active:bg-zinc-100 active:text-zinc-700 transition ease-in-out duration-150">
                    {!! __('pagination.previous') !!}
                </x-splade-link>
            @endif

            @if ($paginator->hasMorePages())
                <x-splade-link href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-zinc-700 bg-white border border-zinc-200 leading-5 rounded-md hover:text-zinc-500 focus:outline-none focus:ring ring-zinc-300 focus:border-blue-300 active:bg-zinc-100 active:text-zinc-700 transition ease-in-out duration-150">
                    {!! __('pagination.next') !!}
                </x-splade-link>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-zinc-500 bg-white border border-zinc-200 cursor-default leading-5 rounded-md">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-zinc-700 dark:text-zinc-200 leading-5">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                @if(app()->getLocale() === 'ar')
                                    <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-zinc-500 bg-white dark:bg-zinc-800 dark:text-zinc-200 dark:border-zinc-700 border-r border-t border-b border-zinc-200 cursor-default rounded-r-md leading-5" aria-hidden="true">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                @else
                                    <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-zinc-500 bg-white dark:bg-zinc-800 dark:text-zinc-200 dark:border-zinc-700 border border-zinc-200 cursor-default rounded-l-md leading-5" aria-hidden="true">

                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                @endif
                        </span>
                    @else
                        @if(app()->getLocale() === 'ar')
                            <x-splade-link href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-zinc-500 bg-white dark:bg-zinc-900 dark:text-zinc-200 dark:border-zinc-700 border-r border-t border-b border-zinc-200 rounded-r-md leading-5 hover:text-zinc-400 focus:z-10 focus:outline-none focus:ring ring-zinc-300 focus:border-blue-300 active:bg-zinc-100 active:text-zinc-500 transition ease-in-out duration-150" aria-label="{{ __('pagination.previous') }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </x-splade-link>
                        @else
                            <x-splade-link href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-zinc-500 bg-white dark:bg-zinc-900 dark:text-zinc-200 dark:border-zinc-700 border border-zinc-200 rounded-l-md leading-5 hover:text-zinc-400 focus:z-10 focus:outline-none focus:ring ring-zinc-300 focus:border-blue-300 active:bg-zinc-100 active:text-zinc-500 transition ease-in-out duration-150" aria-label="{{ __('pagination.previous') }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </x-splade-link>
                        @endif
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-zinc-900 bg-white dark:bg-zinc-800 dark:border-zinc-700 dark:text-zinc-200 border border-zinc-200 cursor-default leading-5">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-zinc-500 bg-white dark:bg-zinc-900 dark:border-zinc-700 dark:text-zinc-200 border border-zinc-200 cursor-default leading-5">{{ $page }}</span>
                                    </span>
                                @else
                                    <x-splade-link href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-zinc-400 bg-white dark:bg-zinc-800 dark:border-zinc-700 dark:text-zinc-200 border border-zinc-200 leading-5 hover:text-zinc-500 focus:z-10 focus:outline-none focus:ring ring-zinc-300 focus:border-blue-300 active:bg-zinc-100 dark:active:bg-zinc-700 active:text-zinc-700 active:dark:text-zinc-400 transition ease-in-out duration-150" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </x-splade-link>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())

                        @if(app()->getLocale() === 'ar')
                            <x-splade-link href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-zinc-500 bg-white dark:bg-zinc-900 dark:border-zinc-700 dark:text-zinc-200 border border-zinc-200 rounded-l-md leading-5 hover:text-zinc-400 focus:z-10 focus:outline-none focus:ring ring-zinc-300 focus:border-blue-300 active:bg-zinc-100 active:text-zinc-500 dark:active:bg-zinc-400 transition ease-in-out duration-150" aria-label="{{ __('pagination.next') }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </x-splade-link>
                        @else
                            <x-splade-link href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-zinc-500 bg-white dark:bg-zinc-900 dark:border-zinc-700 dark:text-zinc-200 border border-zinc-200 rounded-r-md leading-5 hover:text-zinc-400 focus:z-10 focus:outline-none focus:ring ring-zinc-300 focus:border-blue-300 active:bg-zinc-100 active:text-zinc-500 transition ease-in-out duration-150" aria-label="{{ __('pagination.next') }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </x-splade-link>
                        @endif
                    @else
                        @if(app()->getLocale() === 'ar')
                            <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                                <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-zinc-500 bg-white dark:bg-zinc-800 dark:border-zinc-700 dark:text-zinc-200 border border-zinc-200 cursor-default rounded-l-md leading-5" aria-hidden="true">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </span>
                        @else
                            <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                                <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-zinc-500 bg-white dark:bg-zinc-800 dark:border-zinc-700 dark:text-zinc-200 border border-zinc-200 cursor-default rounded-r-md leading-5" aria-hidden="true">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </span>
                        @endif
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
