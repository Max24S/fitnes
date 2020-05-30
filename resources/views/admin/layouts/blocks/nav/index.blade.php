<style>
     a {
         color: #fff;
    }
    a:hover {
        color: #fff;
    }
     .dropdown-menu {
         left: -35px;
     }

     .active
     {
         color: goldenrod!important;
     }
</style>
<div class="">
    <nav class="navbar navbar-expand-md w-100" >
        <div class="row w-100">
            <div class="col-8">
                <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarsExample04">
                    <ul class="navbar-nav mr-auto d-flex w-100">
                        <li class="nav-item mr-5">
                            <a class="nav-link {{(Route::currentRouteName() == 'admin.super.user.index')||(Route::currentRouteName() == 'home')?'active':''}}" href="{{route('admin.super.user.index')}}" >Пользователи</a>
                        </li>
                        <li class="nav-item mr-5">
                            <a class="nav-link {{Route::currentRouteName() == 'admin.super.subject.index'?'active':''}}" href="{{route('admin.super.subject.index')}}"  aria-haspopup="true" aria-expanded="false">Предметы</a>
                        </li>
                        <li class="nav-item mr-5">
                            <a class="nav-link {{Route::currentRouteName() == 'admin.super.grade.index'?'active':''}}" href="{{route('admin.super.grade.index')}}"  aria-haspopup="true" aria-expanded="false">Классы</a>
                        </li>
                        <li class="nav-item mr-5">
                            <a class="nav-link {{Route::currentRouteName() == 'admin.super.classroom.index'?'active':''}}" href="{{route('admin.super.classroom.index')}}"   aria-haspopup="true" aria-expanded="false">Кабинеты</a>
                        </li>
                    </ul>

            </div>
            </div>
            <div class="col-4">
                <div class="user_cabinet d-flex justify-content-end position-relative">

                    <div>
                        @guest
                        @else
                            <div class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu position-absolute" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                    {{ __('Выйти') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                             </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>


