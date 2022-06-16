<!doctype html>
@include('admin.layout.header')
    <body>
            @include('admin.layout.sidebar')
             @php
                $fyyr=DB::table("financialyears")->where("id", session('finyr'))->first()
             @endphp
            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                            <form role="search" class="navbar-form-custom" action="">
                                <div class="form-group">
                                    <input type="text" placeholder="" class="form-control" name="top-search" id="top-search">
                                </div>
                            </form>
                            <ul class="nav navbar-top-links navbar-right">
                                <li>
                                    <a href="{{route('logout')}}">
                                        <i class="fas fa-sign-out-alt"></i>Log out {{$fyyr->finyear}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                        <main>
                                @yield('content')
                        </main>
                </div>
            </div>
                @include('admin.layout.footer')
        </div>
                @include('admin.layout.scripts')
        @yield('scripts')
        @stack('scripts')
    </body>
    </html>

