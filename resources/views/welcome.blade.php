<!DOCTYPE html>
<html>
<head>
    <title>Laravel Image Compress Upload Example</title>
</head>
<body>
    <form method="post" action="{{ route('image.upload') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image">
        <button type="submit">Upload</button>
    </form>
</body>
</html>
