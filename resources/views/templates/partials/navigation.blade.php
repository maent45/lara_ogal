<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!--- search form --->
            @if (Auth::check())
                <form class="navbar-form navbar-left" role="search" action="{{ route('search.results') }}">
                    <div class="form-group">
                        <input type="text" class="form-control" name="query" placeholder="Search" value="{{ old('search') ?: '' }}">
                    </div>
                    <button type="submit" class="btn btn-default">Go</button>
                </form>
            @endif
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <li>
                        <a href="#">
                            <!--- 'user' refers to User model --->
                            {{ Auth::user()->getNameOrUsername() }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('auth.Signout') }}">
                            Sign out
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('auth.signup') }}">
                            Sign up
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('auth.signin') }}">
                            Sign in
                        </a>
                    </li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>