<?php

namespace App\Exports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AnggotaExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return Anggota::with('divisi')->get();
    }

    // Mengatur Judul Kolom (Header)
    public function headings(): array
    {
        return [
            'ID',
            'Nama Lengkap',
            'NIK',
            'Jenis Kelamin',
            'Divisi',
            'Jabatan',
            'Status',
            'No HP'
        ];
    }

    // Mengatur Isi Data per Baris
    public function map($anggota): array
    {
        return [
            $anggota->id,
            $anggota->nama,
            "'" . $anggota->nik, // Tambah kutip agar Excel anggap teks (angka 0 tidak hilang)
            $anggota->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
            $anggota->divisi->nama ?? '-',
            $anggota->jabatan ?? 'Anggota',
            ucfirst($anggota->status),
            "'" . $anggota->no_hp, // Tambah kutip agar Excel anggap teks
        ];
    }

    // Mengatur Desain (Warna Header)
    public function styles(Worksheet $sheet)
    {
        return [
            // Baris 1 (Header) diberi warna Hijau Tua & Teks Putih
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '1B4332'] 
                ]
            ],
        ];
    }
}