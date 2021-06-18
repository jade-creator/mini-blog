@extends('layouts.app')

@section('content')
<div class="container items-center py-12 px-1 mx-auto">
    <form method="POST" action="{{ route('articles.store') }}" class="w-full lg:w-3/4 flex flex-col p-10 px-8 pt-6 mx-auto my-6 mb-4 transition duration-500 ease-in-out transform bg-white border rounded-lg"
        _lpchecked="1" enctype="multipart/form-data">
        @csrf
        <section class="flex flex-col w-full h-full p-1 overflow-auto">
            <header class="flex flex-col items-center justify-center py-12 text-base text-blueGray-500 transition duration-500 ease-in-out transform bg-white border border-dashed rounded-lg focus:border-blue-500 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2">
                <div x-data="imageViewer()">
                    <div class="mb-2">
                        <!-- Show the image -->
                        <template x-if="imageUrl">
                            <div class="flex flex-wrap justify-center mb-3">
                                <img :src="imageUrl" 
                                class="object-cover rounded border border-gray-200" 
                                style="width: 200px; height: 200px;"
                                >
                            </div>
                        </template>
                      
                        <div class="flex flex-wrap flex-col items-center justify-center ">
                            <!-- Show the gray box when image is not available -->
                            <template x-if="!imageUrl">
                                <img src="https://img.icons8.com/plasticine/2x/image.png" alt="No image">
                            </template>
                            
                            <!-- Image file selector -->
                            <label class="flex flex-wrap justify-center cursor-pointer px-2 py-1 my-2 w-36 text-blueGray-500 transition duration-500 ease-in-out transform border rounded-md hover:text-blueGray-600 text-md hover:shadow-outline hover:ring-2 hover:bg-blueGray-100">
                                <template x-if="imageUrl">
                                    <span>Change image</span>
                                </template>

                                <template x-if="!imageUrl">
                                    <span>Upload an image</span>
                                </template>

                                <input name="main_image" class="mt-2" type="file" accept="image/*" @change="fileChosen">
                            </label>
                        </div>
                    </div>
                </div>
            </header>
            @error('main_image')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
        </section>

        <div class="relative pt-4">
            <label for="title" class="text-base leading-7 text-blueGray-500">Title</label>
            <input name="title" value="{{ old('title') }}" type="text" id="title" placeholder="title" autofocus
                class="w-full px-4 py-2 mt-2 mr-4 text-base text-black transition duration-500 ease-in-out transform rounded-lg bg-blueGray-100 border focus:border-blue-500 focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2"
                style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
                
            @error('title')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="flex flex-wrap mt-4 -mx-3">
            <div class="w-full px-3">
                <label class="text-base leading-7 text-blueGray-500" for="body_text"> Body </label>
                <textarea name="body_text" id="body-textarea" class="w-full h-32 px-4 py-2 mt-2 text-base text-blueGray-500 transition duration-500 ease-in-out transform bg-white border rounded-lg focus:border-blue-500 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 apearance-none autoexpand"
                    id="body_text" type="text" placeholder="body..." autofocus>{{ old('body_text') }}
                </textarea>
                
                @error('body_text')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <div class="relative mt-4">
            <label for="category-container" class="text-base leading-7 text-blueGray-500">Categories</label>
            <fieldset name="category-container" id="category-container">
                <div class="flex flex-wrap">
                    @forelse ($categories as $category)
                        <label class="flex items-center m-2">
                            <input value="{{ $category->id }}" @if(is_array(old('categories')) && in_array($category->id, old('categories'))) checked @endif  type="checkbox" name="categories[]" id="{{ $category->name }}" class="form-checkbox">
                            <span class="ml-2 text-blueGray-500">{{ $category->name }}</span>
                        </label>
                    @empty
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox" disabled>
                            <span class="ml-2 text-blueGray-500">No categories found.</span>
                        </label>
                    @endforelse
                </div>
            </fieldset>
        </div>

        <div class="relative my-4">
            <label for="tags" class="text-base leading-7 text-blueGray-500">Tags [space-separated]</label>
            <input name="tags" value="{{ old('tags') }}" type="text" id="tags" placeholder="eg. html laravel tailwind"
                class="w-full px-4 py-2 mt-2 text-base text-black transition duration-500 ease-in-out transform rounded-lg bg-blueGray-100 focus:border-blueGray-500 focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2">
        </div>

        <div x-data="{ disableSubmit: false }" class="flex items-center w-full pt-4">
            <button x-bind:disabled="disableSubmit" @click="disableSubmit = ! disableSubmit" type="submit" class="w-full py-3 text-base uppercase font-bold text-white transition duration-500 ease-in-out transform bg-blue-600 border-blue-600 rounded-md focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2 hover:bg-blue-800 ">
                Post 
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
    <script>
        function imageViewer(src = ''){
            return{
                imageUrl: src,

                fileChosen(event) {
                  this.fileToDataUrl(event, src => this.imageUrl = src)
                },

                fileToDataUrl(event, callback) {
                    if (! event.target.files.length) return

                    let file = event.target.files[0],
                        reader = new FileReader()

                    reader.readAsDataURL(file)
                    reader.onload = e => callback(e.target.result)
                },
            }
        }

        ClassicEditor
            .create( document.querySelector( '#body-textarea' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection