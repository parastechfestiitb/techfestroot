<!doctype html>
<html lang="en">
<head>

</head>
<body>
<h2>Update your name on Certificate</h2>
<h2>Note: You can update name on certificate only once.</h2>
<form action="/2019/certificate/name_update" method="post">
    @csrf
    <input type="text" name="name" value="{{$name}}">
    <input type="hidden" name="id" value="{{$id}}">
    <input type="hidden" name="key" value="{{$key}}">
    <input type="submit" value="Update Name">
</form>

</body>