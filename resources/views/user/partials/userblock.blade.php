<div class="media">
    <div class="media-left">
        <a href="{{ route('profile.index', ['username' => $user->username]) }}">
          <img class="media-object" src="{{ $user->getAvatarUrl() }}" alt="Profile Image">
        </a>
    </div>
    <div class="media-body">
        <h4 class="media-heading"><a href="{{ route('profile.index', ['username' => $user->username]) }}">{{ $user->getUsername() }}</a></h4>
        {{ $user->email }}
    </div>
</div>
