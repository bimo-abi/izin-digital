<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-900 font-bold text-xl">Total Surat</div>
                    <div class="text-3xl">{{ $totalLetters }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-900 font-bold text-xl">Pending</div>
                    <div class="text-3xl text-yellow-600">{{ $pendingLetters }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-900 font-bold text-xl">Disetujui</div>
                    <div class="text-3xl text-green-600">{{ $approvedLetters }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-900 font-bold text-xl">Total Mahasiswa</div>
                    <div class="text-3xl">{{ $totalStudents }}</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Menu Admin</h3>
                <div class="space-x-4">
                    <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded">Kelola Surat</a>
                    <a href="#" class="bg-green-500 text-white px-4 py-2 rounded">Kelola Template</a>
                    <a href="#" class="bg-purple-500 text-white px-4 py-2 rounded">Kelola User</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>