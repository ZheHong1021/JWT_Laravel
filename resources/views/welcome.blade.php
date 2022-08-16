<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        {{-- 網頁標頭圖案 --}}
        <link rel="shortcut icon" href="{{ asset('./favicon.svg') }}">

        {{-- 新增的 --}}
        <link rel="stylesheet" href="/css/app.css" />
        
    </head>
    <body>
        {{-- 原本這邊有HTML內容，但都刪掉了 --}}
        
        {{-- 新增的 --}}
        <script src="/js/app.js"></script>
    </body>
</html>
