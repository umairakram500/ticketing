<div id="searchboxmain" class="searchbox">

    <h4>Get Shedule Now</h4>

    <form method="get" action="{{ route('front.schedules') }}">
        <?php
        $allfrom = \App\Models\City::where(['status' => 1])->orderBy('name')->get();
        ?>
        <select name="depts" class="form-control" required>
            <option value="">Departure</option>
            @if(!empty($allfrom))
                @foreach($allfrom as $from)
                    @php $sel = isset($depts) && $from->id == $depts ? 'selected' : ''; @endphp
                    <option value="{{$from->id}}" {{ $sel }}>{{$from->name}}</option>
                @endforeach
            @endif
        </select>
        <select name="arrive" class="form-control" required>
            <option value="">Arrival</option>
            @if(!empty($allfrom))
                @foreach($allfrom as $from)
                    @php $sel = isset($depts) && $from->id == $arrive ? 'selected' : ''; @endphp
                    <option value="{{$from->id}}" {{ $sel }}>{{$from->name}}</option>
                @endforeach
            @endif
        </select>
        <input type="text" name="date" data-format="Y-m-d"
               data-default-date="{{ isset($_GET['date'])?$_GET['date']:'' }}"
               class="datepicker form-control" />
        <input type="submit" class="btn btn-danger form-control" value="Search">
    </form>

</div>