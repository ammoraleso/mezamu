<div class="p-2">
    <form id="waiter-form" action="{{ route('generateCode') }}" method="POST">
        @csrf

        <div class="form-group label-floating">
            <label class="control-label">{{__('Table')}}</label>
            <select class="form-control" id="table" name="table" required>
                <option disabled selected value style="display:none"></option>
                @for($i =1; $i <= Auth::user()->branch->tables; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <button type="submit" onclick="generateCode()" class="btn btn-success">{{ __('Generate Code') }}</button>
    </form>
    @isset($table,$token)
        <div class="p-3 text-center">
            <strong><p>{{__('You qr code')}} {{$table}}</p></strong>
            <div class="m-auto" style="width: fit-content">{!!QrCode::size(250)->generate($uriRestaurant.Auth::user()->branch->restaurant->slug.'/'.Auth::user()->branch->location.'/'.$table.'/'.$token)!!}</div>
        </div>
    @endisset
</div>
