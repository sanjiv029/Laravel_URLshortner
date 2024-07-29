<x-mail::message>
# New URL Created

<x:mail::panel>
     Original URL :{{$url->original_url}}.
</x:mail::panel>

<x:mail::panel>
    Short URL code :{{$url->short_url}}.
</x:mail::panel>

{{-- <x-mail::button :url="''">
OK
</x-mail::button> --}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
