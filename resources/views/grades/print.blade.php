<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Nilai - E-Rapor</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f5f5;
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        .no-print {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .print-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 13px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s;
        }

        .btn-print {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-download {
            background: #10b981;
            color: white;
        }

        .btn-download:hover {
            background: #059669;
        }

        .report {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #667eea;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #667eea;
            font-size: 26px;
            margin-bottom: 5px;
        }

        .header p {
            color: #666;
            font-size: 12px;
            margin: 3px 0;
        }

        .info-bar {
            background: #f5f5f5;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 15px;
        }

        .info-item {
            font-size: 13px;
        }

        .info-item label {
            font-weight: 600;
            color: #667eea;
            display: block;
            font-size: 11px;
            text-transform: uppercase;
            margin-bottom: 3px;
        }

        .info-item value {
            display: block;
            color: #333;
            font-size: 13px;
        }

        .section-title {
            color: #667eea;
            font-size: 16px;
            font-weight: 700;
            margin-top: 30px;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #667eea;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        table thead {
            background: #667eea;
            color: white;
        }

        table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
        }

        table td {
            padding: 10px 12px;
            font-size: 12px;
            border-bottom: 1px solid #e8ecf4;
        }

        table tbody tr:nth-child(even) {
            background: #f9fafb;
        }

        table tbody tr:hover {
            background: #f0f2ff;
        }

        .score-pass {
            color: #10b981;
            font-weight: 600;
        }

        .score-fail {
            color: #ef4444;
            font-weight: 600;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: 600;
        }

        .status-pass {
            background: #d1fae5;
            color: #065f46;
        }

        .status-fail {
            background: #fee2e2;
            color: #991b1b;
        }

        .summary-stats {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 15px;
            margin-top: 20px;
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px;
            border-radius: 6px;
            text-align: center;
        }

        .stat-card .label {
            font-size: 11px;
            text-transform: uppercase;
            opacity: 0.9;
            margin-bottom: 5px;
        }

        .stat-card .value {
            font-size: 20px;
            font-weight: 700;
        }

        .footer {
            text-align: right;
            margin-top: 40px;
            font-size: 11px;
            color: #999;
            border-top: 1px solid #e8ecf4;
            padding-top: 15px;
        }

        @media print {
            .no-print {
                display: none !important;
            }
            
            body {
                background: white;
            }

            .container {
                padding: 0;
            }

            .report {
                box-shadow: none;
                padding: 20px;
                border-radius: 0;
            }

            table {
                page-break-inside: avoid;
            }

            table thead {
                display: table-header-group;
            }

            .section-title {
                page-break-after: avoid;
            }

            .footer {
                page-break-before: avoid;
            }
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .summary-stats {
                grid-template-columns: 1fr 1fr;
            }

            table {
                font-size: 10px;
            }

            table th, table td {
                padding: 8px;
            }

            .report {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Action Bar -->
        <div class="no-print">
            <div>
                <strong>💾 Export & Print</strong>
                <p style="font-size: 12px; color: #666; margin-top: 3px;">Cetak atau download laporan nilai siswa</p>
            </div>
            <div class="print-buttons">
                <button onclick="window.print()" class="btn btn-print" title="Cetak laporan">
                    <i class="bi bi-printer"></i> Cetak
                </button>
                <a href="#" onclick="downloadPDF(); return false;" class="btn btn-download" title="Download sebagai PDF">
                    <i class="bi bi-download"></i> Download PDF
                </a>
                <a href="{{ route('grades.index') }}" class="btn" style="background: #6b7280; color: white;">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Report -->
        <div class="report">
            <!-- Header -->
            <div class="header">
                <h1>📊 LAPORAN NILAI SISWA</h1>
                <p>Sistem Manajemen Rapor Digital E-Rapor</p>
                <p style="font-size: 11px; margin-top: 10px;">Dicetak pada: {{ date('d F Y H:i:s') }}</p>
            </div>

            <!-- Statistics -->
            @php
                $totalGrades = $grades->count();
                $passCount = $grades->where('score', '>=', 70)->count();
                $failCount = $grades->where('score', '<', 70)->count();
                $avgScore = $grades->avg('score');
            @endphp

            <div class="summary-stats">
                <div class="stat-card">
                    <div class="label">Total Nilai</div>
                    <div class="value">{{ $totalGrades }}</div>
                </div>
                <div class="stat-card">
                    <div class="label">Lulus</div>
                    <div class="value" style="color: #d1fae5;">{{ $passCount }}</div>
                </div>
                <div class="stat-card">
                    <div class="label">Tidak Lulus</div>
                    <div class="value" style="color: #fee2e2;">{{ $failCount }}</div>
                </div>
                <div class="stat-card">
                    <div class="label">Rata-rata</div>
                    <div class="value">{{ number_format($avgScore, 2) }}</div>
                </div>
            </div>

            <!-- Grades Table -->
            <div class="section-title">Daftar Nilai</div>
            
            @if($grades->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th width="40">No.</th>
                            <th>Siswa</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru</th>
                            <th width="60">Nilai</th>
                            <th width="80">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($grades as $index => $grade)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $grade->student->user->name ?? 'N/A' }}</strong>
                                    <br>
                                    <small style="color: #999;">{{ $grade->student->nisn ?? '-' }}</small>
                                </td>
                                <td>{{ $grade->subject->name ?? 'N/A' }}</td>
                                <td>{{ $grade->teacher->name ?? 'N/A' }}</td>
                                <td>
                                    <span class="{{ $grade->score >= 70 ? 'score-pass' : 'score-fail' }}">
                                        {{ $grade->score }}
                                    </span>
                                </td>
                                <td>
                                    @if($grade->score >= 70)
                                        <span class="status-badge status-pass">✓ Lulus</span>
                                    @else
                                        <span class="status-badge status-fail">✗ Tidak Lulus</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div style="text-align: center; padding: 40px; color: #999;">
                    <i class="bi bi-inbox" style="font-size: 48px; opacity: 0.3;"></i>
                    <p style="margin-top: 15px;">Belum ada data nilai</p>
                </div>
            @endif

            <!-- Notes -->
            <div class="info-bar" style="margin-top: 30px;">
                <strong style="display: block; margin-bottom: 8px;">📌 Keterangan:</strong>
                <ul style="margin-left: 20px; font-size: 12px;">
                    <li>Nilai ≥ 70: <strong style="color: #10b981;">LULUS</strong></li>
                    <li>Nilai < 70: <strong style="color: #ef4444;">TIDAK LULUS</strong></li>
                    <li>Laporan ini mencakup semua siswa dan mata pelajaran</li>
                </ul>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>Dokumen ini digenerate dari sistem E-Rapor pada {{ date('d F Y H:i:s') }}</p>
                <p>Bersifat rahasia dan hanya untuk penggunaan sekolah</p>
            </div>
        </div>
    </div>

    <script>
        function downloadPDF() {
            // Gunakan html2pdf library atau browser print-to-PDF
            alert('Klik tombol Cetak dan pilih "Simpan sebagai PDF" atau gunakan print-to-PDF browser Anda');
            window.print();
        }
    </script>
</body>
</html>
