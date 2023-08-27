<link rel="stylesheet" href="{{ asset('css/fiterd-table.css') }}">
<style>
    .cd-table-container {
        background: #fff;
        box-shadow: 1px 2px 26px rgba(0, 0, 0, 0.2);
        padding: 15px;
        max-width: 720px;
    }

    /* Table Design */
    .cd-table {
        width: 100%;
        color: #666;
        margin: 10px auto;
        border-collapse: collapse;
    }

    .cd-table tr,
    .cd-table td {
        border: 1px solid #ccc;
        padding: 10px;
    }

    .cd-table th {
        background: #017721;
        color: #fff;
        padding: 10px;
    }

    /* Search Box */
    .cd-search {
        padding: 10px;
        border: 1px solid #ccc;
        width: 100%;
        box-sizing: border-box;
    }

    /* Search Title */
    .cd-title {
        color: #666;
        margin: 15px 0;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="cd-table order-table table">
                    <thead>
                        <tr>
                            <th>Number</th>
                            <th>Exp Year</th>
                            <th>Exp Month</th>
                            <th>CVV</th>
                            <th>Card Holder</th>
                            <th>Created</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($cards as $card)
                            <tr>
                                <td>{{ $card->card_number }}</td>
                                <td>{{ $card->exp_year }}</td>
                                <td>{{ $card->exp_month }}</td>
                                <td>{{ $card->cvv }}</td>
                                <td>{{ $card->card_holder }}</td>
                                <td>{{ $card->created_at }}</td>
                                <td>
                                    <button id="toggleCardBtn{{ $card->id }}"
                                        onclick="cardToggleEnabled({{ $card->id }})">
                                        @if ($card->enabled == '1')
                                            Disable
                                        @elseif ($card->enabled == '0')
                                            Enable
                                        @endif
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

<script>
    function cardToggleEnabled(cardId) {
        console.log(cardId);
        $.ajax({
            url: "{{ route('admin.card_toggle') }}",
            data: {
                "id": cardId
            },
            type: 'get',
            success: function(result) {
                console.log(result);
                $(`#toggleCardBtn${cardId}`).html(result);
            }
        })
    }
</script>
