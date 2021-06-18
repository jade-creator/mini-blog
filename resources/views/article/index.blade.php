@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-col mb-2 text-left">
            <div class="container items-center px-5 py-12 lg:px-20">
                <div class="flex flex-col lg:flex-row lg:space-x-12">
                    @include('partials.sidebar')

                    <div class="w-full px-4 mt-12 text-lg leading-snug tracking-tight text-blueGray-500 lg:px-0 lg:w-3/4">
                        @include('partials.filter')

                        <div class="mt-5">
                            <div class="container flex flex-col items-center py-8 w-100">
                                @forelse ($articles as $article)
                                    <div class="w-full">
                                        <a href="{{ route('articles.show', ['article' => $article]) }}">
                                            <div class="flex flex-col items-center pb-10 mb-10 rounded-lg border border-gray-200 hover:bg-white p-5 sm:flex-row hover:shadow-lg">
                                                <div class="inline-flex items-center justify-center flex-shrink-0 text-black rounded-full bg-blueGray-50 sm:mr-10">
                                                    @if ($article->getFirstMediaUrl('main_images', 'thumb'))
                                                        <img class="rounded-xl" src="{{ $article->getFirstMediaUrl('main_images', 'thumb') }}" alt="Article Image" style="height:200px; width: 200px;">
                                                    @else
                                                        <img src="https://img.icons8.com/plasticine/2x/image.png" alt="No image" style="width: 200px;" title="No image">
                                                    @endif
                                                </div>
                                                <div class="mt-2 md:mt-0 flex-grow text-center sm:text-left">
                                                    <h2 class="mb-8 text-2xl lg:text-4xl font-semibold leading-none tracking-tighter text-black title-font">{{ Illuminate\Support\Str::of($article->title)->words(10, ' ...') ?? 'N/A'}}</h2>
                                                    <p class="mt-5 text-sm font-bold text-blue-500 uppercase">{{ $article->user->name }} <span class="font-normal normal-case text-gray-400">posted</span> <span class="text-gray-400">{{ $article->created_at->diffForHumans() }}</span></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @empty
                                <div class="w-full">
                                    <div class="flex justify-center items-center pb-10 mb-10 rounded-lg border border-gray-200 bg-white p-5 sm:flex-row hover:shadow-lg">
                                        <p>Sorry, no articles found. 😢</p>
                                    </div>
                                </div>
                                @endforelse                        
                            </div>
                            {{ $articles->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
