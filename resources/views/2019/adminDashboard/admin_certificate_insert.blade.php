<form action="/admindashboard_certificate/insert" method="post">
    @csrf
    <input type="text" name="name" placeholder="Paras" value="Paras Jain" required>
    <input type="text" name="email" placeholder="email" value="parasj.techfest@gmail.com" required>
    <select name="certificate_id" required>
        @foreach($all_certificate as $certificate)
            <option value="{{$certificate->id}}">{{$certificate->id}}-{{$certificate->name}}</option>
        @endforeach
    </select>
    <input type="submit">
</form>