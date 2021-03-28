<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Medyana Hospital</title>
    <meta name="description" content="Medyana Hospital">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    <link rel="stylesheet" id="css-theme" href="{{ asset('assets/css/xplay.min.css') }}">

</head>
<body>
<div id="page-container">
    <main id="main-container">
        <div class="bg-image" style="background-image: url('{{ asset('assets/media/photo14@2x.jpg') }}');">
            <div class="row no-gutters justify-content-center bg-black-75">
                <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                    <!-- Sign In Block -->
                    <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                        <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-white">
                            <!-- Header -->
                            <div class="mb-2 text-center">
                                <a class="link-fx text-primary font-w700 font-size-h1" href="javascript:void(0);">
                                    <span class="text-dark">Med</span><span class="text-primary">yana</span>
                                </a>
                                <p class="text-uppercase font-w700 font-size-sm text-muted">Sign In</p>
                            </div>
                            <div id="login">
                                <login></login>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="{{ asset('assets/js/dashmix.core.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    window._token = '{{ csrf_token() }}';
    window.email = '{{ session('user.email') }}';
</script>
</body>
</html>
