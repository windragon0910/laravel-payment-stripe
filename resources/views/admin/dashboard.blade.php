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
                    <h2 class="cd-title">Search Table Record:</h2>
                    <input type="text" class="cd-search table-filter" data-table="order-table"
                        placeholder="Item to filter.." />

                    <table class="cd-table order-table table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Created</th>
                                <th>Enabled</th>
                                <th>Detail</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <button id="toggleBtn{{ $user->id }}"
                                            onclick="toggleEnabled({{ $user->id }})">
                                            @if ($user->enabled == '1')
                                                Disable
                                            @elseif ($user->enabled == '0')
                                                Enable
                                            @endif
                                        </button>
                                    </td>
                                    <td>
                                        <a href="/user_detail/{{$user->id}}">
                                            Detail
                                        </a>
                                    </td>
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
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="{{ asset('js/filtered-table.js') }}"></script>
<script>
    function toggleEnabled(userId) {
        console.log(userId);
        $.ajax({
            url: "{{ route('admin.toggle') }}",
            data: {
                "id": userId
            },
            type: 'get',
            success: function(result) {
                console.log(result);
                $(`#toggleBtn${userId}`).html(result);
            }
        })
    }
</script>
