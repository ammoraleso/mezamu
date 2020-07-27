<div class="p-2">
    <form id="waiter-form" action="{{ route('generateCode') }}" method="POST">
        @csrf
        <input type="hidden" name="restaurantId" id="restaurantId" value="{{$restaurant->id}}">
        <input type="hidden" name="branchName" id="branchName" value="{{$branch->name}}">

        <div class="form-group label-floating">
            <label class="control-label">{{__('Table')}}</label>
            <select class="form-control" id="table" name="table" required>
                <option disabled selected value style="display:none"></option>
                @for($i =1; $i <= $branch->tables; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <button type="submit" onclick="generateCode()" class="btn btn-success">{{ __('Generate Code') }}</button>
    </form>
    @isset($table,$token)
        <div class="p-3">
            <div class="m-auto" style="width: fit-content">{!!QrCode::generate('http://127.0.0.1/'.$restaurant->slug.'/'.$branchName.'/'.$table.'/'.$token)!!}</div>
        </div>
    @endisset
</div>
