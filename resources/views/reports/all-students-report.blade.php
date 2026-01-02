<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Semua Siswa - E-Rapor</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            max-width: 1200px;
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
            gap: 15px;
        }

        .print-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-family: Poppins, sans-serif;
            font-size: 14px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .print-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .report {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #667eea;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #667eea;
            font-size: 28px;
            margin-bottom: 5px;
        }

        .header p {
            color: #666;
            font-size: 12px;
        }

        .section-title {
            color: #667eea;
            font-size: 16px;
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 15px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        thead {
            background: #667eea;
            color: white;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 12px;
        }

        tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        tbody tr:hover {
            background: #f0f2ff;
        }

        .grade-value {
            font-weight: bold;
            color: #667eea;
        }

        .status {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }

        .status.pass {
            background: #d4edda;
            color: #155724;
        }

        .status.fail {
            background: #f8d7da;
            color: #721c24;
        }

        .footer {
            text-align: right;
            margin-top: 40px;
            font-size: 11px;
            color: #999;
        }

        @media print {
            .no-print {
                display: none;
            }
            body {
                background: white;
            }
            .report {
                box-shadow: none;
                padding: 20px;
            }
            table {
                page-break-inside: avoid;
            }
            table thead {
                display: table-header-group;
            }
        }

        .summary-stats {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
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
            font-size: 24px;
            font-weight: 700;
        }

        .info-bar {
            background: #f5f5f5;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="no-print">
            <div>
                <strong>📄 Laporan Semua Siswa</strong>
                <p style="font-size: 12px; color: #666; margin-top: 3px;">Tekan Ctrl+P untuk cetak atau save PDF</p>
            </div>
            <button class="print-btn" onclick="window.print()">🖨️ Cetak / Download PDF</button>
        </div>

        <div class="report">
            <div class="header">
                <h1>📋 LAPORAN SEMUA SISWA</h1>
                <p>Sistem Manajemen Rapor Digital E-Rapor</p>
                <p style="font-size: 11px; margin-top: 10px;">Dicetak pada: {{ date('d F Y H:i:s') }}</p>
            </div>

            @php
                $totalStudents = $students->count();
                $passCount = 0;
                $failCount = 0;
                
                foreach ($students as $student) {
                    $avg = $student->grades->avg('grade') ?? 0;
                    if ($avg >= 70) {
                        $passCount++;
                    } else {
                        $failCount++;
                    }
                }
            @endphp

            <div class="summary-stats">
                <div class="stat-card">
                    <div class="label">Total Siswa</div>
                    <div class="value">{{ $totalStudents }}</div>
                </div>
                <div class="stat-card">
                    <div class="label">Lulus</div>
                    <div class="value">{{ $passCount }}</div>
                </div>
                <div class="stat-card">
                    <div class="label">Tidak Lulus</div>
                    <div class="value">{{ $failCount }}</div>
                </div>
            </div>

            <div class="section-title">Daftar Siswa & Nilai</div>

            @if($students->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th width="40">No.</th>
                            <th>Nama Siswa</th>
                            <th>NISN</th>
                            <th>Kelas</th>
                            <th width="80">Rata-rata</th>
                            <th width="100">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $index => $student)
                            @php
                                $avgGrade = $student->grades->avg('grade') ?? 0;
                                $status = $avgGrade >= 70 ? 'pass' : 'fail';
                                $statusText = $avgGrade >= 70 ? 'Lulus' : 'Tidak Lulus';
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $student->user->name ?? 'N/A' }}</strong></td>
                                <td>{{ $student->nisn ?? '-' }}</td>
                                <td>{{ $student->studyClass->name ?? 'N/A' }}</td>
                                <td class="grade-value">{{ number_format($avgGrade, 2) }}</td>
                                <td>
                                    <span class="status {{ $status }}">{{ $statusText }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div style="text-align: center; padding: 40px; color: #999;">
                    <p>Belum ada data siswa</p>
                </div>
            @endif

            <div class="info-bar">
                <strong>📌 Keterangan:</strong>
                <ul style="margin-left: 20px; font-size: 12px; margin-top: 8px;">
                    <li>Rata-rata ≥ 70: <strong style="color: #155724;">LULUS</strong></li>
                    <li>Rata-rata < 70: <strong style="color: #721c24;">TIDAK LULUS</strong></li>
                    <li>Laporan mencakup semua siswa dari seluruh kelas</li>
                </ul>
            </div>

            <div class="footer">
                <p>Dokumen ini digenerate dari sistem E-Rapor pada {{ date('d F Y H:i:s') }}</p>
                <p>Bersifat rahasia dan hanya untuk penggunaan sekolah</p>
            </div>
        </div>
    </div>
</body>
</html>
