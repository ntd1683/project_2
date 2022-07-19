<form action="{{route('api.RevenueTest')}}" method="post">
    @csrf
    <select name="data" id="">
        <option value="1">30</option>
        <option value="2">12</option>
    </select>
    <button type="submit">Submit</button>
</form>
