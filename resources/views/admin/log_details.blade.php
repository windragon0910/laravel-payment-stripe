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

<x-app-layout><x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Dashboard') }} </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">You're logged in as an admin!
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <section class="container cd-table-container">
                    <h2 class="cd-title">{{$data[0]}}'s History</h2>
                    <input type="text" class="cd-search table-filter" data-table="order-table"
                        placeholder="Item to filter.." />

                    <table class="cd-table order-table table">
                        <thead>
                            <tr>
                                <th>Url</th>
                                <th>Created </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data[1] as $log)
                                <tr>
                                    <td>{{ $log->url }}</td>
                                    <td>{{ $log->created_at }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </section>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
