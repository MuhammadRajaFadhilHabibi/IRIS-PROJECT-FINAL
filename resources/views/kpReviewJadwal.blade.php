@extends('header')

@section('title','Buat Jadwal')

@section('page')

<div class="flex h-screen">
        {{-- sidebar --}}

        <x-side-bar :active="request()->route()->getName()">
      
        </x-side-bar>
      {{-- end sidebar --}}

    {{-- Main Content --}}
        <div id="main-content" class="flex-1 p-8 bg-gray-200 min-h-screen ml-[340px]">
        <div class="bg-white border border-gray-300 rounded-3xl shadow-md p-6">
            <h1 class="text-3xl font-bold mb-6 text-blue-600 text-center">Jadwal Kuliah S1 {{ $data->prodi }}</h1>

            <div class="overflow-x-auto">
                @php
                    $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
                    $times = ['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'];
                @endphp

                <table class="min-w-full bg-white text-center border border-gray-200">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="py-3 px-4 text-sm font-semibold border-r border-white">Jam</th>
                            @foreach($days as $day)
                                <th class="py-3 px-4 text-sm font-semibold border-r border-white">{{ $day }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($times as $timeIndex => $time)
                            <tr class="{{ $timeIndex % 2 == 0 ? 'bg-gray-50' : 'bg-white' }}">
                                <td class="py-3 px-4 font-semibold border-r border-gray-200">{{ $time }}</td>
                                @foreach($days as $dayIndex => $day)
                                    <td class="py-3 px-4 border-r border-gray-200">
                                        @foreach($data as $schedule)
                                            @if($schedule->hari == $day && substr($schedule->jammulai, 0, 2) == substr($time, 0, 2))
                                                <div class="p-3 mb-2 border border-gray-300 rounded-lg bg-blue-100 shadow-sm">
                                                    <span class="text-xs font-bold text-gray-900">{{ $schedule->matakuliah }} {{ $schedule->kelas }}</span>
                                                    <p class="text-xs text-gray-700">Semester {{$schedule->plotsemester}} <br> {{ $schedule->sks }} SKS <br> {{ $schedule->jammulai }} - {{ $schedule->jamselesai }}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
 