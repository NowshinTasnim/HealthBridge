@extends('layouts.lab')

@section('content')
@php $page = 'Lab_profile'; @endphp

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6 text-center" style="color: #4b0082;">Profile</h1>


        {{-- Lab Details --}}
        <div class="border p-4 rounded" style="border: 2px solid #a855f7; border-radius: 5px; margin:20px">
            <div style=" margin: 30px">
                <h4 class="text-xl font-semibold mb-4" style="color: #4b0082;" >Basic Information</h4>
                <p style="text-indent: 1.5em;"><strong>Name:</strong> {{ $lab->Lab_Name }}</p>
                <p style="text-indent: 1.5em;"><strong>Address:</strong> {{ $lab->Physical_address }}</p>
                <p style="text-indent: 1.5em;"><strong>License No:</strong> {{ $lab->License_no }}</p>
                <p style="text-indent: 1.5em;"><strong>Phone:</strong> {{ $lab->Phone_no }}</p>
                <p style="text-indent: 1.5em;"><strong>Email:</strong> {{ $lab->Email }}</p>
            </div>
        </div>

        {{-- Available Tests --}}
        <div class="border p-4 rounded mb-6" style="border: 2px solid #a855f7; border-radius: 5px; margin:20px">
            <div style=" margin: 30px">
                <h4 class="text-xl font-semibold mb-4" style="color: #4b0082;">Available Supported Tests</h4>
                <ul class="space-y-4" style="margin-left: 25px;margin-right: 25px;">
                    @foreach ($availableTests as $test)
                        <li class="flex items-center justify-between bg-gray-100 p-3 rounded">
                            <span class="text-gray-700">{{ $test->Test_name }}</span>
                            <form method="POST" action="{{ route('Lab.updateTest') }}" class="ml-auto">
                                @csrf

                                <input type="hidden" name="LabID" value="{{ $lab->LabID }}">
                                <input type="hidden" name="TestID" value="{{ $test->TestID }}">
                                <input type="hidden" name="Action" value="Delete">
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded transition" style= "border-radius: 5px;"
                                onmouseover="this.style.backgroundColor='#991b1b';" onmouseout="this.style.backgroundColor= '#ef4444';">
                                    Delete
                                </button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Add New Tests --}}
        <div class="border p-4 rounded" style="border: 2px solid #a855f7; border-radius: 5px; margin:20px">
            <div style=" margin: 30px">
                <h4 class="text-xl font-semibold mb-4" style="color: #4b0082;" >Want to Add Tests?</h4>
                <form method="POST" action="{{ route('Lab.updateTest') }}">
                    @csrf
                    <input type="hidden" name="LabID" value="{{ $lab->LabID }}">
                    <div class="space-y-3">
                        @foreach ($allTests as $test)
                            <div class="flex items-center bg-gray-100 p-3 rounded" style="margin-left: 25px;margin-right: 25px; padding:6px;">
                                <input type="checkbox" name="TestID[]" value="{{ $test->TestID }}" class="mr-2">
                                <span class="text-gray-700">{{ $test->Test_name }}</span>
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="Action" value="Add">
                    <button type="submit" class="bg-purple-800 text-white px-5 py-2 mt-4 rounded hover:bg-purple-700 transition block mx-auto"
                    style="width: 80px; border-radius: 5px">Add
                    </button>
                </form>
            </div>
        </div>
    </div>


@endsection
