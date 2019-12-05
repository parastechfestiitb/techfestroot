<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
<form action="/payment_fix" method="post">
    {!! csrf_field() !!}
{{--    <input type="text" name="ticketId" placeholder="ticketId" >--}}
    <input type="text" name="ticketId" placeholder="ticketId" >
{{--    <input type="text" name="email" placeholder="registered email" >--}}
{{--    <input type="text" name="email_payment" placeholder="payment email" >--}}
    <button type="submit">Update</button>
    {{$id}}
</form>

</body>
</html>
