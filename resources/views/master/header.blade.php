<header>
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynav">
          <span class="sr-only">Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="brand">
          <img src="{{ asset('img/logo.png') }}" alt="Logo">
          <a href="{{ action('HomeController@index') }}">Homy</a>
        </div>
      </div>

      <div class="collapse navbar-collapse" id="mynav">
        <ul class="nav navbar-nav navbar-right">
          <!-- Authentication Links -->
          @guest
              <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
              <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
          @else
              <li class="nav-item dropdown">
                  <a href="{{ action('LessonController@index') }}">Lessons</a>
                  <a href="{{ action('LessonController@resources') }}">Resources</a>
                  <a href="{{ action('PartnerPostController@index') }}">Groups</a>
                  <a id="user-navbar-dropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->username }} <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu" aria-labelledby="user-navbar-dropdown">
                      <a href="{{ action('UserController@profile', Auth::user()->username) }}">Profile</a>
                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </div>
              </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>
</header>
