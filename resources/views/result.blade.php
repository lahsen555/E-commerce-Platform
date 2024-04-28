@if(count($members) > 0)
    @foreach ($members as $member)
        <li>{{$member->name}}</li>
    @endforeach
@endif