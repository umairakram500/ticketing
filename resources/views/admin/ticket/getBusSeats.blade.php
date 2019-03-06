
    <?php

    $total_seats = $schedule->luxuryType->seats;
    $old = old('seat');
    $last_row = round($total_seats/4);
    $row = 1;
    ?>
    @for($i=1; $i<=$total_seats; $i++)
        @if(isset($seats[$i]))
            <span class="booked icon-{{ $seats[$i] == 'M' ? 'man' : 'woman' }} paid_{{ $paid[$i] }}"><span>{{ $i
                            }}</span></span>
        @else
            <span onclick="seatSelect({{ $i }})" class="seat_{{$i}}">{{ $i }}
                @if(isset($old[$i]))
                    <span class="icon-{{ ($old[$i]=='M'?'man':'woman') }}"></span>
                    <input type="checkbox" value="{{ $old[$i] }}" data-seat="{{$i}}" class="seats seat-{{ $i }} hidden" name="seat[{{ $i }}]" checked>
                @else
                    <input type="checkbox" data-seat="{{$i}}" class="seats seat-{{ $i }} hidden" name="seat[{{ $i }}]">
                @endif
                        </span>
        @endif

        @if($last_row != $row)
            @if($i%4==0)
                <?php $row++; ?>
                <div class="clearfix"></div>
            @elseif($i%2==0)
                <span class="speac"></span>
            @endif
        @endif
    @endfor
    <div class="clearfix"></div>