@extends('layouts.admin')

@section('content')
<h1>Laporan Keuangan Bulanan</h1>

<form method="POST" action="{{ route('keuangan.laporan') }}">
    @csrf
    <div style="display: flex; gap: 1rem; align-items: center;">
        <div class="form-group">
            <label for="tahun">Tahun:</label>
            <select class="form-control" name="tahun" id="tahun">
                <option value="" selected disabled>Pilih Tahun</option>
                @foreach ($tahunBulan as $tahun => $bulans)
                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="bulan">Bulan:</label>
            <select class="form-control" name="bulan" id="bulan">
                <option value="" selected disabled>Pilih Bulan</option>
                @if(isset($tahun) && isset($tahunBulan[$tahun]))
                    @foreach ($tahunBulan[$tahun] as $bulanItem)
                        <option value="{{ str_pad($bulanItem->bulan, 2, '0', STR_PAD_LEFT) }}">
                            {{ DateTime::createFromFormat('!m', $bulanItem->bulan)->format('F') }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tampilkan</button>
    </div>
</form>

@if(isset($laporan))
    <h2 class="mt-4">Laporan Bulanan: {{ $bulanOptions[$bulan] }} {{ $tahun }}</h2>
    <a href="{{ route('keuangan.download', ['tahun' => request('tahun'), 'bulan' => request('bulan')]) }}" 
        class="btn btn-success mt-2 mb-3">Cetak Laporan</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jumlah Transaksi</th>
                <th>Penghasilan</th>
                <th>Rincian</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $data)
                <tr>
                    <td>{{ date('d M Y', strtotime($data->tanggal)) }}</td>
                    <td>{{ $data->jumlah_transaksi }}</td>
                    <td>{{ number_format($data->penghasilan, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('keuangan.detail', ['tanggal' => $data->tanggal]) }}">
                            Lihat Detail…
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
