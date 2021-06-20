@extends('layouts.app')

@section('content')
    <div class="container mt-5 px-5 mx-auto lg:px-32">
        <div class="flex flex-col w-full mb-2 text-left ">
            <h1 class="my-2 text-3xl font-black tracking-tightertext-black lg:text-7xl md:text-4xl"> 
                {{ $article->title ?? 'N/A' }}
            </h1>
            <p class="text-md leading-snug tracking-tight text-blueGray-500 lg:w-2/3 italic">Posted {{ $article->created_at->diffForHumans() ?? 'N/A' }}</p>
            <div class="flex items-center py-2 block lg:hidden mt-3">
                <i class="far fa-user p-3 object-cover w-10 h-10 mr-2 rounded-full bg-blue-100"></i>
                <div class="flex items-center justify-between w-full">
                    <div>
                        <p class="text-sm font-semibold tracking-tight text-black ">{{ $article->user->name ?? 'N/A' }}</p>
                        <p class="mt-1 text-sm font-normal tracking-tight text-coolGray-400">{{ $article->user->email ?? 'N/A' }}</p>
                    </div>
                    <button class="focus:outline-none font-bold text-blue-500 hover:text-white hover:bg-blue-400 border border-blue-400 rounded-lg py-2 px-4">
                        Follow
                    </button>
                </div>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row lg:space-x-12">
            <div class="hidden lg:block w-full max-w-screen-sm mt-12 lg:w-1/4">
                <div class="p-4 transition duration-500 ease-in-out transform bg-white border rounded-lg ">
                    <div class="flex py-2">
                        <i class="far fa-user p-3 object-cover w-10 h-10 mr-2 rounded-full bg-blue-100"></i>
                        <div class="truncate">
                            <p class="text-sm font-semibold tracking-tight text-black">{{ $article->user->name ?? 'N/A' }}</p>
                            <p class="mt-1 text-sm font-normal tracking-tight text-coolGray-400">{{ $article->user->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <button class="w-full px-8 py-2 mt-4 text-base text-white transition duration-500 ease-in-out transform bg-blue-600 border-blue-600 rounded-md focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2 hover:bg-blue-800">
                        Follow on Twitter 
                    </button>
                </div>
            </div>

            <div class="w-full px-4 mt-6 text-lg leading-snug tracking-tight text-blueGray-500 lg:px-0 lg:max-w-2xl break-words">
                <p class="pb-6">{!! $article->body_text !!}</p>

                <div class="pt-4 mt-4 transition duration-500 ease-in-out transform">
                    <label for="tags" class="text-gray-500">Categories:</label>
                    <div name="tags" class="flex flex-wrap mt-3">
                        @forelse ($article->categories as $category)
                            <a href="{{ route('articles.index', ['category_id' => $category->id]) }}">
                                <button class="underline focus:outline-none text-gray-600 hover:text-blue-500 px-2 py-1 m-1">
                                    {{ $category->name }}
                                </button>
                            </a>
                        @empty
                        N/A
                        @endforelse
                    </div>
                </div>

                <div class="pt-4 my-4 transition duration-500 ease-in-out transform">
                    <label for="tags" class="text-gray-500">Tags:</label>
                    <div name="tags" class="flex flex-wrap mt-3">
                        @forelse ($article->tags as $tag)
                            <a href="{{ route('articles.index', ['tag_id' => $tag->id]) }}">
                                <button class="focus:shadow-outline focus:outline-none text-gray-400 hover:text-blue-400 hover:bg-blue-100 rounded-lg bg-gray-200 px-2 py-1 m-1">
                                    {{ $tag->name }}
                                </button>
                            </a>
                        @empty
                        N/A
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
