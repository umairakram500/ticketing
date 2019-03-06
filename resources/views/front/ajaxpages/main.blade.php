

@if(!empty($arrivs))
<option>Arrival</option>
@forelse($arrivs as $arriv)
<option value="{{$arriv->to_city_id}}">{{$arriv->to_city->name}}</option>
@empty
<option>No Destination </option>
@endforelse
@endif