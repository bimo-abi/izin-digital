<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mahasiswa Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <a href="{{ route('mahasiswa.letters.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                    + Buat Surat Baru
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Riwayat Surat Saya</h3>
                
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Surat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keperluan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($letters as $letter)
                        <tr>
                            <td class="px-6 py-4">{{ $letter->template->name }}</td>
                            <td class="px-6 py-4">{{ Str::limit($letter->purpose, 30) }}</td>
                            <td class="px-6 py-4">
                                @if($letter->status == 'pending')
                                    <span class="px-2 py-1 text-xs text-yellow-800 bg-yellow-200 rounded">Pending</span>
                                @elseif($letter->status == 'approved')
                                    <span class="px-2 py-1 text-xs text-green-800 bg-green-200 rounded">Disetujui</span>
                                @else
                                    <span class="px-2 py-1 text-xs text-red-800 bg-red-200 rounded">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $letter->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('mahasiswa.letters.show', $letter) }}" class="text-blue-600 hover:text-blue-900">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada surat</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $letters->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>