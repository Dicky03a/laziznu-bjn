<!DOCTYPE html>
<html>

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Laporan PCNU Laziznu Bojonegoro</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white">
      <!-- Header Blue Bar -->
      <div class="h-2 bg-blue-900"></div>

      <!-- Main Container -->
      <div class="max-w-4xl mx-auto px-8 py-12">
            <!-- Header -->
            <div class="text-center mb-12">
                  <div class="mb-4">
                        <div class="text-xl font-bold text-gray-900 mb-2 tracking-wide">LAZISNU BOJONEGORO</div>
                        <div class="text-xs text-gray-600">LEMBAGA ZAKAT INFAQ SHODAQAH NAHDLATUL ULAMA</div>
                  </div>

                  <h1 class="text-3xl font-bold text-gray-900 mb-3">
                        {{ $report_title }}
                  </h1>

                  <div class="inline-block bg-blue-100 px-6 py-2 rounded-full mb-4">
                        <p class="text-gray-700 font-semibold text-sm">Laporan Transaksi</p>
                  </div>

                  <div class="text-gray-600 text-sm">
                        Periode: Semua Waktu
                  </div>
            </div>

            <!-- Content -->
            <div class="space-y-8 mb-20">
                  @if($transactions->count() > 0)
                  <!-- Detail Transaksi -->
                  <div>
                        <h3 class="text-sm font-bold text-gray-900 mb-4">A. DETAIL TRANSAKSI</h3>

                        <div class="overflow-x-auto">
                              <table class="w-full border-collapse">
                                    <thead>
                                          <tr class="bg-black">
                                                <th class="border border-black px-3 py-2 text-left text-white font-bold text-xs w-10">No</th>
                                                <th class="border border-black px-3 py-2 text-left text-white font-bold text-xs w-20">Tanggal</th>
                                                <th class="border border-black px-3 py-2 text-left text-white font-bold text-xs w-32">Nama Donatur</th>
                                                <th class="border border-black px-3 py-2 text-left text-white font-bold text-xs w-24">Tipe</th>
                                                <th class="border border-black px-3 py-2 text-left text-white font-bold text-xs">Nama Program</th>
                                                <th class="border border-black px-3 py-2 text-right text-white font-bold text-xs w-28">Jumlah</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          @foreach($transactions as $index => $transaction)
                                          <tr class="@if($index % 2 == 0) bg-gray-50 @else bg-white @endif">
                                                <td class="border border-gray-300 px-3 py-2 text-xs text-center">{{ $index + 1 }}</td>
                                                <td class="border border-gray-300 px-3 py-2 text-xs">{{ $transaction->created_at->format('d/m/Y') }}</td>
                                                <td class="border border-gray-300 px-3 py-2 text-xs">{{ $transaction->is_anonim ? 'Hamba Allah' : $transaction->nama_donatur }}</td>
                                                <td class="border border-gray-300 px-3 py-2 text-xs">
                                                      @if($transaction->type === 'infaq')
                                                      DSKL
                                                      @elseif($transaction->type === 'donasi')
                                                      Infaq
                                                      @else
                                                      {{ ucfirst($transaction->type) }}
                                                      @endif
                                                </td>
                                                <td class="border border-gray-300 px-3 py-2 text-xs">{{ $transaction->program?->nama ?? 'Program Tidak Terdaftar' }}</td>
                                                <td class="border border-gray-300 px-3 py-2 text-xs text-right">Rp {{ number_format($transaction->jumlah, 0, ',', '.') }}</td>
                                          </tr>
                                          @endforeach
                                    </tbody>
                              </table>
                        </div>
                  </div>

                  <!-- Total Per Program -->
                  <div>
                        <h3 class="text-sm font-bold text-gray-900 mb-4 underline">B. TOTAL PER PROGRAM</h3>

                        <div class="overflow-x-auto">
                              <table class="w-full border-collapse">
                                    <thead>
                                          <tr class="bg-black">
                                                <th class="border border-black px-4 py-2 text-left text-white font-bold text-xs">Nama Program</th>
                                                <th class="border border-black px-4 py-2 text-center text-white font-bold text-xs w-20">Jumlah</th>
                                                <th class="border border-black px-4 py-2 text-right text-white font-bold text-xs w-28">Total (Rp)</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          @foreach($totalByProgram as $program => $summary)
                                          <tr class="bg-white hover:bg-gray-50">
                                                <td class="border border-gray-300 px-4 py-2 text-xs font-semibold">{{ $summary['program_name'] }}</td>
                                                <td class="border border-gray-300 px-4 py-2 text-xs text-center">{{ $summary['count'] }}</td>
                                                <td class="border border-gray-300 px-4 py-2 text-xs text-right">{{ number_format($summary['total'], 0, ',', '.') }}</td>
                                          </tr>
                                          @endforeach
                                          <tr class="bg-gray-100">
                                                <td class="border border-black px-4 py-2 text-xs font-bold">JUMLAH TOTAL</td>
                                                <td class="border border-black px-4 py-2 text-xs text-center font-bold">{{ $transactions->count() }}</td>
                                                <td class="border border-black px-4 py-2 text-xs text-right font-bold">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                                          </tr>
                                    </tbody>
                              </table>
                        </div>
                  </div>

                  <!-- Footer -->
                  <div class="mt-20 pt-8">
                        <div class="mb-8 text-left text-xs">
                              Bojonegoro, {{ $generatedDate->format('d F Y') }}
                              <br><br>
                              Mengetahui,
                        </div>

                        <div class="grid grid-cols-2 gap-10">
                              <div class="text-center">
                                    <div class="text-xs font-bold mb-16">Ketua LAZISNU</div>
                                    <div class="border-t-2 border-black pt-1 text-xs">(.....................)</div>
                                    <div class="text-xs italic text-gray-600 mt-1">Ketua</div>
                              </div>

                              <div class="text-center">
                                    <div class="text-xs font-bold mb-16">Bendahara</div>
                                    <div class="border-t-2 border-black pt-1 text-xs">(.....................)</div>
                                    <div class="text-xs italic text-gray-600 mt-1">Bendahara</div>
                              </div>
                        </div>
                  </div>

                  @else
                  <div class="text-center py-12 italic text-gray-500">
                        <p>Tidak ada data transaksi {{ $title }} yang dikonfirmasi.</p>
                  </div>
                  @endif
            </div>
      </div>

      <!-- Decorative Wave Footer -->
      <div class="relative mt-12 pt-8">
            <svg
                  viewBox="0 0 1440 120"
                  class="w-full h-auto"
                  preserveAspectRatio="none">
                  <path
                        d="M0,40 Q360,0 720,40 T1440,40 L1440,120 L0,120 Z"
                        fill="#f5e6d3"
                        opacity="0.8"></path>
                  <path
                        d="M0,50 Q360,20 720,50 T1440,50 L1440,120 L0,120 Z"
                        fill="#f9ede6"
                        opacity="0.6"></path>
            </svg>
      </div>
</body>

</html>