<?php

namespace App\Exports;

use App\Models\SuratDispensasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanDispensasiExport implements FromCollection, WithHeadings, WithMapping
{
    protected $no = 1;

    public function collection()
    {
        return SuratDispensasi::withTrashed()
            ->with(['siswa', 'jenisSurat', 'logs'])
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Siswa',
            'Kelas',
            'Jenis Surat',
            'Status',
            'Waktu Dispen',
            'Waktu Kembali',
            'Catatan Terakhir',
        ];
    }

    public function map($item): array
    {
        $logDispen = $item->logs
            ->where('status', 'dispen')
            ->sortBy('waktu')
            ->first();

        $logKembali = $item->logs
            ->where('status', 'kembali')
            ->sortByDesc('waktu')
            ->first();

        return [
            $this->no++,
            $item->siswa->nama ?? '-',
            $item->siswa->kelas ?? '-',
            $item->jenisSurat->nama ?? '-',
            strtoupper($item->statusTerakhir() ?? '-'),
            $logDispen?->waktu?->format('d-m-Y H:i'),
            $logKembali?->waktu?->format('d-m-Y H:i'),
            $item->logs->last()?->catatan ?? '-',
        ];
    }
}
