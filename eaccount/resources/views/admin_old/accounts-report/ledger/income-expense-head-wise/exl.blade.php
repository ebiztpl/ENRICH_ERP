@extends('layouts.pdf')
@section('title')
    {{ $extra['module_name'] }}
@endsection
@section('content')
    <div class="mid">
        @foreach ($items as $income_expense_head)
            @if ($income_expense_head->Transaction->count() > 0)
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                        <h4 class="text-center mb-3">{{ $income_expense_head->name }}</h4>
                        <table class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">SL. No</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Branch Name</th>
                                    <th scope="col">Mode Of Payment</th>
                                    <th scope="col">Cheque Number</th>
                                    <th scope="col">Particulars</th>
                                    <th scope="col">Voucher No</th>
                                    <th scope="col">Type Of Voucher</th>
                                    <th class="text-right" scope="col">Dr ( <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?> )
                                    </th>
                                    <th class="text-right" scope="col">Cr ( <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?> )
                                    </th>
                                    <th class="text-right" scope="col">Balance
                                        ( <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?> )
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $balance = 0;
                                @endphp
                                @foreach ($income_expense_head->Transaction as $key => $transaction)
                                    @if ($income_expense_head->type)
                                        {{-- Dr 1 Cr 0 --}}
                                        <?php $balance += $transaction->dr - $transaction->cr; ?> {{-- Dr=Dr-Cr --}}
                                    @else
                                        <?php $balance += $transaction->cr - $transaction->dr; ?> {{-- Cr=Cr-Dr --}}
                                    @endif
                                    <tr>
                                        <th class="text-center" scope="row">{{ $key + 1 }}</th>
                                        <td>{{ date(config('settings.date_format'), strtotime($transaction->voucher_date)) }}
                                        </td>
                                        <td> {{ $transaction->Branch ? $transaction->Branch->name : '' }} </td>
                                        <td> {{ $transaction->BankCash ? $transaction->BankCash->name : '' }} </td>
                                        <td> {{ $transaction->cheque_number }} </td>
                                        <td> {{ $transaction->particulars }} </td>
                                        <td class="text-center"> {{ $transaction->voucher_no }} </td>
                                        <td> {{ $transaction->voucher_type }} </td>
                                        <td class="text-right">{{ Helper::convertMoneyFormat($transaction->dr) }}
                                        </td>
                                        <td class="text-right">{{ Helper::convertMoneyFormat($transaction->cr) }}
                                        </td>
                                        <td class="text-right">{{ Helper::convertMoneyFormat($balance) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th class="text-right" colspan="10">Total =</th>
                                    <th class="text-right">{{ Helper::convertMoneyFormat($balance) }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
            @endif
        @endforeach
    </div>
@stop
