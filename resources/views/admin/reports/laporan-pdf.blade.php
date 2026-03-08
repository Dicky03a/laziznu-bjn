<!DOCTYPE html>
<html>

<head>
      <meta charset="UTF-8">
      <title>Laporan PCNU Laziznu Bojonegoro</title>

      <style>
            @page {
                  margin: 40px 50px;
            }

            body {
                  font-family: "Times New Roman", serif;
                  font-size: 14px;
                  line-height: 1.5;
            }

            .container {
                  width: 100%;
            }

            .header {
                  text-align: center;
                  border-bottom: 2px solid black;
                  padding-bottom: 10px;
                  margin-bottom: 20px;
            }

            .logo {
                  width: 70px;
            }

            .header-table {
                  width: 100%;
                  border: 0;
            }

            .header-table td {
                  border: 0;
                  vertical-align: top;
            }

            .title {
                  font-size: 18px;
                  font-weight: bold;
            }

            .subtitle {
                  color: #0a7a0a;
                  font-weight: bold;
            }

            .email {
                  color: #0047ab;
                  text-decoration: underline;
            }

            .row {
                  width: 100%;
                  margin-bottom: 15px;
            }

            .row table {
                  width: 100%;
                  border: 0;
            }

            .row td {
                  border: 0;
            }

            .judul {
                  text-align: center;
                  font-weight: bold;
                  font-size: 18px;
                  margin: 20px 0;
            }

            .paragraph {
                  text-align: justify;
                  margin-bottom: 15px;
            }

            table {
                  width: 100%;
                  border-collapse: collapse;
                  margin-top: 10px;
            }

            table,
            th,
            td {
                  border: 1px solid black;
            }

            th {
                  text-align: center;
                  padding: 6px;
            }

            td {
                  padding: 6px;
            }

            .text-center {
                  text-align: center;
            }

            .text-right {
                  text-align: right;
            }

            .total {
                  margin-top: 10px;
            }

            .ttd {
                  width: 100%;
                  margin-top: 200px;
            }

            .ttd table {
                  width: 100%;
                  border: 0;
                  text-align: center;
            }

            .ttd td {
                  border: 0;
                  width: 33%;
            }

            .spacer {
                  height: 70px;
            }

            tr {
                  page-break-inside: avoid;
            }
      </style>
</head>

<body>

      <div class="container">

            <!-- HEADER -->
            <div class="header">

                  <table class="header-table">

                        <tr>
                              <td>
                                    <!-- <img src="{{ public_path('images/logo.png') }}" width="80"> -->
                                    <div class="title">
                                          PENGURUS CABANG NAHDLATUL ULAMA BOJONEGORO
                                    </div>

                                    <div class="subtitle">
                                          Lembaga Amil Zakat Infaq dan Shodaqoh Nahdlatul Ulama (LAZISNU)
                                    </div>

                                    <div>
                                          Gedung PCNU Bojonegoro
                                    </div>

                                    <div>
                                          Jl. Ahmad Yani No. 12 Bojonegoro 62115
                                    </div>

                                    <div>
                                          085257578178 | 08113321926
                                    </div>

                                    <div class="email">
                                          Email: pc.lazisnu.bojonegoro@gmail.com
                                    </div>

                              </td>

                        </tr>

                  </table>

            </div>


            <!-- NOMOR -->
            <div class="row">

                  <table>

                        <tr>

                              <td>
                                    Perihal : Laporan Penerimaan Infaq / Sedekah <br>
                              </td>

                              <td align="right">
                                    Bojonegoro, {{ $generatedDate->format('d F Y') }}
                              </td>

                        </tr>

                  </table>

            </div>


            <!-- JUDUL -->
            @php
            $type = $transactions->first()->type ?? null;
            @endphp

            <div class="judul">
                  BERITA ACARA PENGHITUNGAN
                  @if($type === 'infaq')
                  DSKL DANA SOSIAL KEAGAMAAN LAINYA
                  @elseif($type === 'donasi')
                  INFAQ SHODAQOH DAN PEDULI BENCANA
                  @else
                  {{ ucfirst($type) }}
                  @endif
            </div>


            <!-- PARAGRAF -->
            <div class="paragraph">
                  Pada hari ini, ______ tanggal ______ bulan ______ tahun ______,
                  kami yang bertanda tangan di bawah ini telah melakukan
                  penghitungan penerimaan Zakat/Infaq/Sedekah yang
                  dilaksanakan oleh LAZISNU PCNU Bojonegoro,
                  dengan rincian sebagai berikut:
            </div>


            @if($transactions->count() > 0)

            <table>

                  <thead>
                        <tr>
                              <th width="40">No</th>
                              <th width="90">Tanggal</th>
                              <th>Nama Donatur</th>
                              <th width="100">Jenis ZIS</th>
                              <th>Program</th>
                              <th width="120">Total Nominal (Rp)</th>
                        </tr>
                  </thead>

                  <tbody>

                        @foreach($transactions as $index => $transaction)

                        <tr>

                              <td class="text-center">
                                    {{ $index+1 }}
                              </td>

                              <td class="text-center">
                                    {{ $transaction->created_at->format('d/m/Y') }}
                              </td>

                              <td>
                                    {{ $transaction->is_anonim ? 'Hamba Allah' : $transaction->nama_donatur }}
                              </td>

                              <td class="text-center">

                                    @if($transaction->type === 'infaq')
                                    DSKL
                                    @elseif($transaction->type === 'donasi')
                                    Infaq
                                    @else
                                    {{ ucfirst($transaction->type) }}
                                    @endif

                              </td>

                              <td>
                                    {{ $transaction->program?->nama ?? 'Program Tidak Terdaftar' }}
                              </td>

                              <td class="text-right">
                                    {{ number_format($transaction->jumlah,0,',','.') }}
                              </td>

                        </tr>

                        @endforeach

                  </tbody>

            </table>


            <div class="total">
                  Total keseluruhan penerimaan ZIS : <br>
                  Rp {{ number_format($grandTotal,0,',','.') }}
            </div>


            <div class="paragraph">
                  Penghitungan dilakukan secara terbuka dan disaksikan
                  oleh para petugas terkait. Demikian berita acara ini
                  dibuat dengan sebenar-benarnya untuk digunakan
                  sebagaimana mestinya.
            </div>


            <!-- TTD -->
            <div class="ttd">

                  <table>

                        <tr>

                              <td>
                                    Petugas Penghitung
                                    <div class="spacer"></div>
                                    (.....................)
                              </td>

                              <td>
                                    Saksi
                                    <div class="spacer"></div>
                                    (.....................)
                              </td>

                              <td>
                                    Penanggung Jawab
                                    <div class="spacer"></div>
                                    (.....................)
                              </td>

                        </tr>

                  </table>

            </div>


            @else

            <div style="text-align:center;margin-top:50px;">
                  Tidak ada data transaksi.
            </div>

            @endif


      </div>

</body>

</html>