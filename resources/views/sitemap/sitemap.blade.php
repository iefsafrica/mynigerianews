<?php /*echo'<?xml version="1.0" encoding="UTF-8"?>'; */?><!--

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">-->
    {{--@foreach($latestnewses as $latestnews )
    <url>
        <loc>{{URL::to(strtolower($latestnews->news_category))}}</loc>
        <priority>1</priority>
        <lastmod>{{$latestnews->created_at,1.0}}</lastmod>
        <changefreq>daily</changefreq>
    </url>
    @endforeach--}}
<!-- Apple Favicon -->
<link rel="apple-touch-icon" href="{{ asset(settings()->favicon) }}">
<!-- All Device Favicon -->
<link rel="icon" href="{{ asset(settings()->favicon) }}">

<!-- Bootstrap -->
<link rel="stylesheet" href="{{ asset('public/frontend/css/bootstrap.min.css') }}">

<div class="container">
    <div>
        <h3>Sitemap</h3>
    </div>
    <table class=" table table-bordered">
        <thead>
        <tr>
            <th>URL</th>
            <th>last update date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($latestnewses as $latestnews )
            <tr>
                <td> <a href="{{URL::to($latestnews->slug.'/details/'.$latestnews->id.'/'.Str::slug($latestnews->title))}}">{{URL::to($latestnews->slug.'/details/'.$latestnews->id.'/'.Str::slug($latestnews->title))}}</a></td>
                <td> {{$latestnews->created_at,1.0}} </td>
            </tr>
        @endforeach
        </tbody>
    </table>


</div>

<!-- jQuery -->
<script src="{{ asset('public/frontend/js/vendor/jquery-3.6.0.min.js') }} "></script>
<!-- Popper -->
<script src="{{ asset('public/frontend/js/vendor/popper.min.js') }} "></script>
<!-- Bootstrap -->
<script src="{{ asset('public/frontend/js/vendor/bootstrap.min.js') }} "></script>
<!-- Slick -->
<script src="{{ asset('public/frontend/js/vendor/slick.min.js') }} "></script>
<!-- Counter Up -->
<script src="{{ asset('public/frontend/js/vendor/counterup.min.js') }} "></script>
<!-- Waypoints -->
<script src="{{ asset('public/frontend/js/vendor/waypoints.min.js') }} "></script>
<!-- Venobox -->
<script src="{{ asset('public/frontend/js/vendor/venobox.min.js') }} "></script>
<!-- Index -->
<script src="{{ asset('public/frontend/js/index.js') }} "></script>
<!-- toastr -->
<script src="{{ asset('public/admin/plugins/toastr/toastr.min.js') }} "></script>


{{--</urlset>--}}
