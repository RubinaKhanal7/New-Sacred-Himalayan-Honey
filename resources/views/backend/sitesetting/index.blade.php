@extends('layouts2.superadmin')


@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <h1>Sitesetting</h1>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Office Name</th>
                <th>Office Email</th>
                <th>Office Contact</th>
                <th>Office Logo</th>
                <th>Slogan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sitesettings as $sitesetting)
                <tr data-widget="expandable-table" aria-expanded="false">
                    <td width="5%">{{ $loop->iteration }}</td>
                    <td>{{ $sitesetting->office_name ?? '' }}</td>
                    <td> @if (!empty($sitesetting->office_email))
                        @php
                            $officeEmails = json_decode($sitesetting->office_email, true);
                        @endphp
                        @if (is_array($officeEmails))
                            @foreach ($officeEmails as $email)
                                {{ $email }} <br>
                            @endforeach
                        @else
                            {{ $sitesetting->office_email }} <br>
                        @endif
                    @endif</td>
                    <td>
                        @if (!empty($sitesetting->office_contact))
                            @php
                                $officeContacts = json_decode($sitesetting->office_contact, true);
                            @endphp
                            @if (is_array($officeContacts))
                                @foreach ($officeContacts as $contact)
                                    {{ $contact }} <br>
                                @endforeach
                            @else
                                {{ $sitesetting->office_contact }} <br>
                            @endif
                        @endif
                    </td>
                    <td>
                        <img id="preview{{ $loop->iteration }}"
                            src="{{ asset('uploads/sitesetting/' . $sitesetting->main_logo) }}"
                            style="width: 150px; height:150px" />
                    </td>
                    <td>{{ $sitesetting->slogan ?? '' }}</td>
                    <td>
                        <div style="display: flex; flex-direction:row;">
                            <a href="{{ route('backend.sitesettings.edit', $sitesetting->id) }}"
                                class="btn btn-warning btn-sm" style="margin-right: 5px;">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection