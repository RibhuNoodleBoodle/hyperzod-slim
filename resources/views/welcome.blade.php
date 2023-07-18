<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Hyperzod</title>
</head>
<body>
    <div id="app">
        <product-list></product-list> <!-- Vue component placeholder -->
    </div>

    <!-- Include the Laravel Mix asset -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
