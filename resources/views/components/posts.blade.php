@props(['post' => $post])

<div class="mb-4">
    <a href="{{route('users.posts', $post->user)}}" class="font-bold">{{$post->user->name}}</a><span class="ml-3 text-gray text-sm">
        {{$post->created_at->diffForHumans()}}</span>
    <p class="mb-2">
        {{$post->body}}
        @can('delete', $post)
        <form action="{{route('posts.delete', $post)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-blue-500 mr-2">Delete</button>
        </form>
        @endcan
        <div class="flex item-center">
            @auth
            @if (!$post->likedBy(auth()->user()))
            <form action="{{route('posts.like', $post->id)}}" method="post">
                @csrf
                <button type="submit" class="text-blue-500 mr-2">Like</button>
            </form>
            @else
            <form action="{{route('posts.like', $post)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-blue-500 mr-2">Unlike</button>
            </form>
            @endif
            @endauth
            {{$post->likes->count()}} {{Str::plural('like', $post->likes->count())}}
        </div>
    </p>
</div>
