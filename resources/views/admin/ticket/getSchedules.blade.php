<?php
$schedule_id = old('schedule_id');
?>
@forelse($schedules as $k => $schedule)
<tr data-schedule="{{ $schedule->id }}" data-route="{{ $schedule->route_id }}" data-type="{{ $schedule->luxury_type }}" class="{{ $schedule_id&&$schedule->id==$schedule_id?'active':'' }}">
    <td>{{ $k+1 }} <input type="hidden" name="schedules[]" value="{{ $schedule->id }}"> </td>
    <td>{{ $schedule->depart_time }}</td>
    <td>{{ $schedule->route->title ?? '' }}</td>
    <td>{{ $schedule->luxuryType->title ?? '' }}</td>
    <td>{{ $schedule->luxuryType->seats ?? '' }}</td>
    {{--<td>500</td>--}}
    <td>{{ $schedule->tickets()->sumof($bookingdate, 0) }}</td>
    <td>{{ $schedule->tickets()->sumof($bookingdate, 1) }}</td>
    <td>{{  $schedule->luxuryType->seats - $schedule->tickets()->sumof($bookingdate) }}</td>
    <td>-</td>
    <td>-</td>
</tr>

@empty
    <tr>
        <td colspan="11">Not found</td>
    </tr>
@endforelse