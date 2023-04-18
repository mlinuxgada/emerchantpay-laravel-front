<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EmerchantPay RSS CRUD Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        
        <h1 class="text-primary mt-3 mb-4 text-center"><b>EmerchantPay RSS Crud Application</b></h1>
        
        <nav class="navbar navbar-expand-lg bg-light">
          <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('rss_urls.index') }}" class="btn btn-outline-dark">RSS Feeds</a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('rss_items.index') }}" class="btn btn-outline-dark">RSS Posts</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>

        @yield('content')
        
    </div>
    
</body>
</html>
