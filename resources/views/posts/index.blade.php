@extends('layouts.app')
@section('content')
<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        @auth
        <form action="{{route('posts')}}" method="post" class="mb-4">
            @csrf
            <div class="mb-4">
                <label for="body" class="sr-only">Body</label>
                <textarea name="body" id="body" cols="30" rows="4"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"
                    placeholder="Write your status!"></textarea>
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
        @endauth
        @guest
            <h1 class="text-center text-xl py-3 font-bold"> Register Right Now And Send Your Message at <span class="text-yellow-500">Statusin</span>!</h1>
        @endguest
        @if($posts->count())
        @foreach ($posts as $p)
        <div class="mb-4">
            <a href="#" class="font-bold">{{$p->user->name}}</a><span class="ml-3 text-gray text-sm">
                {{$p->created_at->diffForHumans()}}</span>
            <p class="mb-2">
                {{$p->body}}
                @can('delete', $p)
                <form action="{{route('posts.delete', $p)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-blue-500 mr-2">Delete</button>
                </form>
                @endcan
                <div class="flex item-center">
                    @auth
                    @if (!$p->likedBy(auth()->user()))
                    <form action="{{route('posts.like', $p->id)}}" method="post">
                        @csrf
                        <button type="submit" class="text-blue-500 mr-2">Like</button>
                    </form>
                    @else
                    <form action="{{route('posts.like', $p)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-blue-500 mr-2">Unlike</button>
                    </form>
                    @endif
                    @endauth
                    {{$p->likes->count()}} {{Str::plural('like', $p->likes->count())}}
                </div>
            </p>
        </div>
        @endforeach
        {{$posts->links()}}
        @else
        <h1 class="text-center mb-4">No Data</h1>
        @endif
    </div>
</div>
@endsection
