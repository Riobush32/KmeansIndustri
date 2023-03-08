<!doctype html>
<html data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body>
    <h1 class="text-3xl font-bold underline">
        Hello world!
    </h1>
    <button class="btn">Button</button>
    <button class="btn btn-primary">Button</button>
    <button class="btn btn-secondary">Button</button>
    <button class="btn btn-accent">Button</button>
    <button class="btn btn-ghost">Button</button>
    <a href="{{ route('kmeans.index') }}" class="btn btn-link">Data</a>
</body>

</html>