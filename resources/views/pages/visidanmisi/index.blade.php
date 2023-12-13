@extends('layouts.app')

@section('body')
    <div class="flex items-center justify-between py-5 px-5 mx-10">
        <h1 class="font-bold text-2xl mb-0 text-gray-700">Visi dan Misi Universitas 'Aisyiyah Yogyakarta
        </h1>
    </div>
    <hr />


    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-gray-500 text-justify">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="px-6 py-3">

                    </th>
                    <th scope="col" class="px-6 py-3">
                        Universitas
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fakultas
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Prodi
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b text-justify">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                        Visi
                    </th>
                    <td class="px-6 py-4">
                        @foreach ($visiU as $visiUniv)
                            <p class="mb-2 font-bold  ">
                                {{ $visiUniv->Visi }}
                            </p>
                        @endforeach
                    </td>
                    <td class="px-6 py-4">
                        @foreach ($visiF as $visiFakultas)
                            <p class="mb-2 font-bold  ">
                                {{ $visiFakultas->Visi }}
                            </p>
                        @endforeach
                    </td>
                    <td class="px-6 py-4">
                        @foreach ($visiP as $visiProdi)
                            <p class="mb-2 font-bold  ">
                                {{ $visiProdi->Visi }}
                            </p>
                        @endforeach
                    </td>
                </tr>
                <tr class="bg-white border-b ">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                        Misi
                    </th>
                    <td class="px-6 py-4">
                        @foreach ($misiU as $misiUniv)
                            <p class="mb-2 font-bold  ">
                                {{ $loop->iteration }}. {{ $misiUniv->Misi }}
                            </p>
                        @endforeach


                    </td>
                    <td class="px-6 py-4">
                        @foreach ($misiF as $misiFakultas)
                            <p class="mb-2 font-bold  ">
                                {{ $loop->iteration }}. {{ $misiFakultas->Misi }}
                            </p>
                        @endforeach
                    </td>
                    <td class="px-6 py-4">
                        @foreach ($misiP as $misiProdi)
                            <p class="mb-2 font-bold  ">
                                {{ $loop->iteration }}. {{ $misiProdi->Misi }}
                            </p>
                        @endforeach
                    </td>
                </tr>
                <tr class="bg-white ">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900  whitespace-nowrap ">
                        Tujuan
                    </th>
                    <td class="px-6 py-4">
                        @foreach ($tujuanU as $tujuanUniv)
                            <p class="mb-2 font-bold ">
                                {{ $loop->iteration }}. {{ $tujuanUniv->Tujuan }}
                            </p>
                        @endforeach
                    </td>
                    <td class="px-6 py-4">
                        @foreach ($tujuanF as $tujuanFakultas)
                            <p class="mb-2 font-bold ">
                                {{ $loop->iteration }}. {{ $tujuanFakultas->Tujuan }}
                            </p>
                        @endforeach
                    </td>
                    <td class="px-6 py-4">
                        @foreach ($tujuanP as $tujuanProdi)
                            <p class="mb-2 font-bold ">
                                {{ $loop->iteration }}. {{ $tujuanProdi->Tujuan }}
                            </p>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
