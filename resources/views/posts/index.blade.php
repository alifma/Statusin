@extends('layouts.app')
@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <form action="{{route('posts')}}" method="post" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="30" rows="4"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Write your status!"></textarea>
                    @error('body')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <input type="submit" class="bg-green-500 text-white px-4 py-2 rounded font-medium" value="Post">
                </div>
            </form>

            @forelse ($posts as $p)
            <div class="mb-4">
                <a href="#" class="font-bold">{{$p->user->name}}</a><span class="ml-3 text-gray text-sm"> {{$p->created_at->diffForHumans()}}</span>
                <p class="mb-2">
                    {{$p->body}}
                </p>
            </div>
            @empty
            <h1 class="text-center">No Data</h1>
            @endforelse
        </div>
    </div>
@endsection
