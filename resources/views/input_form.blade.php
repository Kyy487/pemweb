<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Nilai Mata Pelajaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if (session('success'))
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">{{ session('success') }}</div>
                @endif
                
                @if ($errors->any())
                    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                        <strong>Input Error!</strong> Silakan cek kembali input Anda.
                    </div>
                @endif

                <form action="{{ route('grades.input.form') }}" method="GET" class="mb-8 p-4 border rounded-lg bg-gray-50">
                    <h3 class="font-semibold text-lg mb-4">Pilih Kelas & Mata Pelajaran</h3>
                    <div class="flex space-x-4">
                        <div class="flex-1">
                            <label for="class_id" class="block text-sm font-medium text-gray-700">Kelas</label>
                            <select name="class_id" id="class_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required onchange="this.form.submit()">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" {{ $classId == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-1">
                            <label for="subject_id" class="block text-sm font-medium text-gray-700">Mata Pelajaran</label>
                            <select name="subject_id" id="subject_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required onchange="this.form.submit()">
                                <option value="">-- Pilih Mapel --</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ $subjectId == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>

                @if ($students->count() > 0)
                    <h3 class="font-semibold text-xl mb-4">Input Nilai Kelas: {{ $classes->where('id', $classId)->first()->name ?? '' }} - Mapel: {{ $subjects->where('id', $subjectId)->first()->name ?? '' }}</h3>
                    
                    <form action="{{ route('grades.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="class_id" value="{{ $classId }}">
                        <input type="hidden" name="subject_id" value="{{ $subjectId }}">

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">Nilai (0-100)</th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-5/12">Deskripsi Singkat</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($students as $index => $student)
                                        @php
                                            // Cek apakah siswa sudah punya nilai untuk mapel ini
                                            $existingGrade = $student->grades->first();
                                        @endphp
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $student->name }}</td>
                                            
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="hidden" name="grades[{{ $index }}][student_id]" value="{{ $student->id }}">
                                                <input type="number" 
                                                       name="grades[{{ $index }}][score]" 
                                                       min="0" max="100" 
                                                       required 
                                                       value="{{ old('grades.' . $index . '.score', $existingGrade->score ?? '') }}"
                                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-1">
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="text" 
                                                       name="grades[{{ $index }}][description]" 
                                                       value="{{ old('grades.' . $index . '.description', $existingGrade->description ?? '') }}"
                                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-1">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md shadow hover:bg-blue-700">
                                Simpan Nilai
                            </button>
                        </div>
                    </form>
                @elseif ($classId || $subjectId)
                    <div class="p-4 text-center text-gray-500 border rounded-lg">
                        Tidak ada siswa di kelas ini atau data tidak ditemukan.
                    </div>
                @else
                    <div class="p-4 text-center text-gray-500 border rounded-lg">
                        Silakan pilih Kelas dan Mata Pelajaran untuk memulai input nilai.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>