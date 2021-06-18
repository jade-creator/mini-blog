<div class="w-full max-w-screen-sm m-auto mt-12 pt-5 lg:w-1/4 sticky top-0 hidden lg:block">
    <a href="{{ route('articles.create') }}">
        <button class="w-full px-8 py-4 uppercase font-bold text-white transition duration-500 ease-in-out transform bg-blue-600 border-blue-600 rounded-full focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2 hover:bg-blue-800">
            New Article
        </button>
    </a>

    <div class="pt-4 mt-4 transition duration-500 ease-in-out transform">
        <a href="{{ route('articles.index') }}">
            <button class="{{ request()->input('query') == 'this week' ? 'w-full px-8 py-3 text-base text-gray-400 hover:text-blue-400 font-bold transition duration-500 ease-in-out transform rounded-xl focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2 border border-transparent hover:border-blue-200' 
                : 'text-blue-400 border border-blue-200 w-full px-8 py-3 text-base font-bold transition duration-500 ease-in-out transform rounded-xl focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2' }}">
                <i class="far fa-newspaper mr-3"></i> All Articles
            </button>
        </a>

        <a href="{{ route('articles.index', ['query' => 'this week']) }}">
            <button class="{{ request()->input('query') == 'this week' ? 'mt-3 text-blue-400 border border-blue-200 w-full px-8 py-3 text-base font-bold transition duration-500 ease-in-out transform rounded-xl focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2' 
                : 'mt-3 w-full px-8 py-3 text-base text-gray-400 hover:text-blue-400 font-bold transition duration-500 ease-in-out transform rounded-xl focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2 border border-transparent hover:border-blue-200' }}">
                <i class="fas fa-calendar-week mr-3"></i> This week
            </button>
        </a>
    </div>

    <div class="pt-4 mt-4 transition duration-500 ease-in-out transform">
        <label for="tags" class="text-gray-500">Recent Tags:</label>
        <div name="tags" class="flex flex-wrap mt-3">
            @forelse ($tags->take(10) as $tag)
                <a href="{{ route('articles.index', ['tag_id' => $tag->id]) }}">
                    <button class="{{ request()->input('tag_id') == $tag->id ? 'shadow-outline outline-none text-blue-400 bg-blue-100 rounded-lg bg-gray-200 px-2 py-1 m-1' 
                        : 'focus:shadow-outline focus:outline-none text-gray-400 hover:text-blue-400 hover:bg-blue-100 rounded-lg bg-gray-200 px-2 py-1 m-1' }}">
                        {{ $tag->name }}
                    </button>
                </a>
            @empty
                N/A
            @endforelse
        </div>
    </div>
</div>
