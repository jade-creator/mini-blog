<div class="flex items-center justify-between pt-3">
    <div class="relative md:mr-6 my-2 w-full">
        <div class="relative text-gray-600 focus-within:text-gray-400">
            <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </span>
            <form action="{{ route('articles.index') }}" method="GET">
                <input name="query" value="{{ request()->input('query') }}" type="search" id="query" class="w-full p-2 border border-gray-200 text-sm text-white rounded-full pl-10 focus:outline-none bg-white focus:text-gray-900 focus:border-blue-300 focus:shadow-outline-blue" placeholder="Search..." autofocus autocomplete="on">
            </form>
        </div>
    </div>

    <div class="hidden md:block">
        <div class="flex z-50">
            <div class="flex items-center justify-center mr-2">
                <div x-data="{ open: false }" class="relative inline-block text-left dropdown">
                    <span class="rounded-md shadow-sm">
                        <button @click="open = ! open" @click.away="open = false" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-200 rounded-full hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800" 
                            type="button" aria-haspopup="true" aria-expanded="true" aria-controls="headlessui-menu-items-117">
                            <span class="inline-flex justify-center items-center"><i class="fas fa-list"></i><span>&nbsp;&nbsp;categories</span></span>
                            <svg class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </span>
                    <div x-cloak :class="{'opacity-1 visible translate-y-0 scale-100': open, 'opacity-0 invisible': ! open}" class="dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95">
                        <div class="max-h-80 overflow-y-auto absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none" aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                            <div class="py-1">
                                @forelse ($categories as $category)
                                    <a href="{{ route('articles.index', ['category_id' => $category->id]) }}" tabindex="{{ $category->id }}" class="{{ request()->input('category_id') == $category->id ? 'text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left bg-blue-100' : 'text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left hover:bg-blue-100' }}"  role="menuitem" >{{ $category->name }}</a>
                                @empty
                                    <a role="button" class="text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left">no categories found.</a>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>              
            </div>

            <div class="flex items-center justify-center">
                <div x-data="{ open: false }" class="relative inline-block text-left dropdown">
                    <span class="rounded-md shadow-sm">
                        <button @click="open = ! open" @click.away="open = false" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-200 rounded-full hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800" 
                            type="button" aria-haspopup="true" aria-expanded="true" aria-controls="headlessui-menu-items-117">
                            <span class="inline-flex justify-center items-center"><i class="fas fa-hashtag"></i><span>&nbsp;&nbsp;tags</span></span>
                            <svg class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </span>
                    <div x-cloak :class="{'opacity-1 visible translate-y-0 scale-100': open, 'opacity-0 invisible': ! open}" class="dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95">
                        <div class="max-h-80 overflow-y-auto absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none" aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                            <div class="py-1">
                                @forelse ($tags as $tag)
                                    <a href="{{ route('articles.index', ['tag_id' => $tag->id]) }}" tabindex="{{ $tag->id }}" class="{{ request()->input('tag_id') == $tag->id ? 'text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left bg-blue-100' : 'text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left hover:bg-blue-100' }}"  role="menuitem" >{{ $tag->name }}</a>
                                @empty
                                    <a role="button" class="text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left">no tags found.</a>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>              
            </div>
        </div>
    </div>
</div>
