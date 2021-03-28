<header id="page-header">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <!-- Logo -->
            <div class="">

                <img src="{{ asset('assets/media/logo.png') }}" height="60" alt="">
            </div>
            <!-- END Logo -->
        </div>
        <div>
            <a href="{{ route('clinics.index') }}" class="btn btn-dual" aria-expanded="false">
                <span class="d-none d-sm-inline-block">Clinics</span>
            </a>
            <a href="{{ route('equipments.index') }}" class="btn btn-dual" aria-expanded="false">
                <span class="d-none d-sm-inline-block">Equipments</span>
            </a>
        </div>
        <div>
            @auth
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-user d-sm-none"></i>
                        <span class="d-none d-sm-inline-block">{{ auth()->user()->name }}</span>
                        <i class="fa fa-fw fa-angle-down ml-1 d-none d-sm-inline-block"></i>
                    </button>


                    <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                        <div class="p-2">
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('login.logout') }}">
                                <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i> {{ __('DawnstarLang::auth.log_out') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </div>

    <div id="page-header-loader" class="overlay-header bg-primary-darker">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="fa fa-fw fa-2x fa-sun fa-spin text-white"></i>
            </div>
        </div>
    </div>
</header>
