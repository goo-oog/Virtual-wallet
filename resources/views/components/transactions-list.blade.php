<div class="border-t border-gray-400 pb-3">
    @if($transaction->is_fraudulent)
        <div class="text-xs text-white text-center bg-red-400">Fraudulent</div>
    @endif
    <div class="flex xs:flex-wrap md:flex-nowrap xs:justify-end md:justify-between md:space-x-8 lg:space-x-24 sm:space-y-4 md:space-y-0 p-2
        @if($transaction->is_fraudulent) bg-red-100 @else hover:bg-yellow-50 @endif">
        <div class="flex justify-between xs:w-full space-x-8">
            <div class="w-44 sm:whitespace-nowrap">{{$transaction->created_at->format('d.m.Y H:i')}}</div>
            <div class="w-full">{{$transaction->description}}</div>
            <div class="w-32 text-right whitespace-nowrap">{{sprintf('%0.2f €',$transaction->amount/100)}}</div>
        </div>
        <div class="flex space-x-4 items-end">
            <form method="post" action="/transaction/fraudulent"
                  class="text-center text-sm">
                @csrf
                <input type="hidden" name="_method" value="patch">
                <input type="hidden" name="id" value="{{$transaction->id}}">
                <input type="hidden" name="wallet_id" value="{{$transaction->wallet_id}}">
                <input type="submit"
                       value="{{$transaction->is_fraudulent?'Safe':'Fraudulent'}}"
                       class="{{$transaction->is_fraudulent?
                              'hover:border-green-600 hover:text-green-600 w-20 bg-transparent hover:bg-green-50 border rounded border-gray-400':
                              'hover:border-red-500 hover:text-red-500 w-20 bg-transparent border rounded border-gray-400'}}">
            </form>
            <form method="get" action="/transaction/show-form/delete" class="text-center text-sm">
                @csrf
                <input type="hidden" name="id" value="{{$transaction->id}}">
                <input type="hidden" name="wallet_id" value="{{$transaction->wallet_id}}">
                <input type="submit" value="Delete"
                       class="hover:text-white hover:bg-red-400 px-2 bg-transparent border rounded border-gray-400">
            </form>
        </div>
    </div>
</div>