<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>Custom File</h2>
  <p>To create a custom file upload, wrap a container element with a class of .custom-file around the input with type="file". Then add the .custom-file-input to the file input:</p>
    <form method="POST" action="{{ route('face.store') }}"  enctype="multipart/form-data">
        @csrf
    <p>Default file:</p>
    <input type="file" id="myFile" name="image">
  
    <div class="mt-3">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
</div>
@if (!empty($croppedImage))
<img src="data:image/png;base64,{{$croppedImage->image_base64}}" alt="Red dot" />
@endif
</body>
</html>
