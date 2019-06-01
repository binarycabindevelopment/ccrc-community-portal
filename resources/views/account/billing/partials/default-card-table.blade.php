@if($billingMethod && !empty($billingMethod->getDefaultCardBrand()))
    <table class="table table-bordered text-left m-4" style="border-collapse:collapse">
        <tr>
            <td class="py-4 px-6 border-b border-grey-light"><span class="label label-primary">{{ $billingMethod->getDefaultCardBrand() }}</span></td>
            <td class="py-4 px-6 border-b border-grey-light">****-****-****-{{ $billingMethod->getDefaultCardLast4() }}</td>
            <td class="py-4 px-6 border-b border-grey-light">EXP: {{ $billingMethod->getDefaultCardExpMonth() }} / {{ $billingMethod->getDefaultCardExpYear() }}</td>
            <td class="text-right py-4 px-6 border-b border-grey-light">
                @if(!empty($admin))
                    <a href="{{ url('/manage/user/'.$user->id.'/billing/edit') }}" class="btn btn-default">Update Card</a>
                @else
                    <a href="{{ url('/account/billing/edit') }}" class="btn btn-default">Update Card</a>
                @endif
            </td>
        </tr>
    </table>
@else
    <p class="alert alert-warning">No billing methods available. <a href="{{ url('/account/billing/edit') }}" class="btn btn-default">Click here to add a billing method</a></p>
@endif