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
                    <h1 class="text-lg">Add Card</h1>
                    <!-- component -->
                    <div class="max-w-sm mx-auto mt-20 bg-white rounded-md shadow-md overflow-hidden">
                        <div class="px-6 py-4 bg-gray-100 text-gray-500">
                            <h1 class="text-lg font-bold">Credit Card</h1>
                        </div>
                        <div class="px-6 py-4">

                            <form action="/add_card" method="post">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-bold mb-2" for="card-number">
                                        Card Number
                                    </label>
                                    <input
                                        class="appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="card-number"
                                        type="text"
                                        placeholder="**** **** **** ****"
                                        name="card_number"
                                    >
                                </div>

                                <div class="mb-4 w-full flex items-center">
                                    <div>
                                        <label class="block text-gray-700 font-bold mb-2" for="expiration-date">
                                            Expiration Year
                                        </label>
                                        <input
                                            class="appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="expiration-year"
                                            type="text"
                                            placeholder="YYYY"
                                            name="exp_year"
                                        >
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-bold mb-2" for="expiration-date">
                                            Expiration Month
                                        </label>
                                        <input
                                            class="appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="expiration-month"
                                            type="text"
                                            placeholder="MM"
                                            name="exp_month"
                                        >
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 font-bold mb-2" for="cvv">
                                        CVV
                                    </label>
                                    <input
                                        class="appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="cvv"
                                        type="text"
                                        placeholder="***"
                                        name="cvv"
                                    >
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 font-bold mb-2" for="cvv">
                                        Cardholder Name
                                    </label>
                                    <input
                                        class="appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        type="text"
                                        placeholder="Full Name"
                                        name="card_holder"
                                    >
                                </div>

                                <input type="submit" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
