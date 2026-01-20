<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rapor Kelas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            background: #f5f5f5;
        }

        .no-print {
            background: white;
            padding: 20px;
            margin: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            gap: 10px;
            align-items: center;
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
        }

        .print-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .container {
            padding: 40px;
            max-width: 1000px;
            margin: 20px auto;
            background: white;
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

        .class-info {
            background: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 30px;
            border-left: 4px solid #667eea;
        }

        .info-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 10px;
        }

        .info-item label {
            font-weight: bold;
            color: #333;
            display: block;
            font-size: 11px;
            text-transform: uppercase;
        }

        .info-item {
            font-size: 13px;
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
            font-size: 11px;
        }

        thead {
            background: #667eea;
            color: white;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
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
            .container {
                box-shadow: none;
                margin: 0;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="no-print">
        <button class="print-btn" onclick="window.print()">🖨️ Cetak / Download PDF</button>
        <span style="color: #999; font-size: 12px;">Tekan Ctrl+P atau klik tombol cetak untuk download sebagai PDF</span>
    </div>

    <div class="container">
        <div class="header">
            <h1>📊 RAPOR KELAS</h1>
            <p>Sistem Manajemen Rapor Digital E-Rapor</p>
        </div>

        <div class="class-info">
            <div class="info-row">
                <div class="info-item">
                    <label>Nama Kelas</label>
                    <div>{{ $studyClass->name }}</div>
                </div>
                <div class="info-item">
                    <label>Wali Kelas</label>
                    <div>{{ $studyClass->homeroomTeacher->name ?? 'N/A' }}</div>
                </div>
            </div>
            <div class="info-row">
                <div class="info-item">
                    <label>Jumlah Siswa</label>
                    <div>{{ count($studentGrades) }}</div>
                </div>
                <div class="info-item">
                    <label>Tanggal Cetak</label>
                    <div>{{ date('d-m-Y') }}</div>
                </div>
            </div>
        </div>

        <div class="section-title">Daftar Nilai Siswa</div>
        
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Siswa</th>
                    <th>NISN</th>
                    <th>Total Nilai</th>
                    <th>Rata-rata</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($studentGrades as $index => $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data['student']->user->name }}</td>
                        <td>{{ $data['student']->nisn ?? 'N/A' }}</td>
                        <td>{{ count($data['grades']) }}</td>
                        <td class="grade-value">{{ number_format($data['avg'], 2) }}</td>
                        <td>
                            @if($data['avg'] >= 70)
                                ✓ Lulus
                            @else
                                ✗ Tidak Lulus
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: #999;">Tidak ada data siswa</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="footer">
            <p>Dokumen ini dicetak dari sistem E-Rapor pada {{ date('d F Y H:i') }}</p>
        </div>
    </div>
</body>
</html>
