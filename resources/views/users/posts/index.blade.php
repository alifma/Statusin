@extends('layouts.app')
@section('content')
<div class="flex justify-center">
    <div class="w-8/12">
        <div class="p-6">
            <h1 class="text-3xl font-bold">{{$users->name}}</h1>
            <h3>Has Posted {{$posts->count()}} {{Str::plural('Post', $posts->count())}} And Receive {{$users->receivedLikes->count()}} Likes</h3>
        </div>
        <div class="bg-white p-6 rounded-lg">
            @if ($posts->count())
                @foreach ($posts as $p)
                <x-posts :post="$p"/>
                @endforeach
                {{$posts->links()}}
            @else
                <h1 class="text-center text-2xl mb-4">{{$user->name}} does not have any status.</h1>
            @endif
        </div>
    </div>
</div>
@endsection
