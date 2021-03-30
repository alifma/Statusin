@component('mail::message')
# Yout Post Was Liked!

{{$liker->name}} was liked your post

@component('mail::button', ['url' => route('posts.show', $post)])
View Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
