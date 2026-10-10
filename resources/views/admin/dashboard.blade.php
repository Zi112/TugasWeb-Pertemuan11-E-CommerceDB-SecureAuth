<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard Admin</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                @foreach ($stats as $label => $value)
                    <div class="rounded-lg bg-white p-5 shadow-sm">
                        <p class="text-sm text-gray-500">{{ $label }}</p>
                        <p class="mt-1 text-2xl font-bold text-gray-900">{{ number_format($value, 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>

            <div class="overflow-hidden rounded-lg bg-white shadow-sm">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-500">
                        <tr><th class="px-4 py-3">Nama</th><th class="px-4 py-3">Email</th><th class="px-4 py-3">Role</th></tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $u)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $u->name }}</td>
                                <td class="px-4 py-2">{{ $u->email }}</td>
                                <td class="px-4 py-2"><span class="rounded-full bg-gray-100 px-2 py-0.5">{{ $u->role }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
