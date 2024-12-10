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

    <section class="content">
        <div class="container-fluid">
            <form id="quickForm" method="POST" action="{{ route('backend.sitesettings.update', $sitesetting->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $sitesetting->id }}">
                <div class="card-body">
                    <div>
                        <div class="form-group">
                            <label for="office_name">Office Name</label>
                            <input type="text" name="office_name" class="form-control" placeholder="Office Name"
                                id="office_name" value="{{ $sitesetting->office_name }}">
                        </div>

                        <div class="form-group" id="office_addresses_container">
                            <label for="office_address">Office Address</label>
                            @foreach(json_decode($sitesetting->office_address) as $address)
                                <div class="input-group mb-3">
                                    <input type="text" name="office_address[]" class="form-control" placeholder="Address" value="{{ $address }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary remove-address" type="button">-</button>
                                        <button class="btn btn-outline-secondary add-address" type="button">+</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
        
                        <div class="form-group" id="office_contacts_container">
                            <label for="office_contact">Office Contact</label>
                            @foreach(json_decode($sitesetting->office_contact) as $contact)
                                <div class="input-group mb-3">
                                    <input type="text" name="office_contact[]" class="form-control" placeholder="Office Contact" value="{{ $contact }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary remove-contact" type="button">-</button>
                                        <button class="btn btn-outline-secondary add-contact" type="button">+</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group" id="office_emails_container">
                            <label for="office_email">Office Emails</label>
                            @foreach(json_decode($sitesetting->office_email) as $email)
                                <div class="input-group mb-3">
                                    <input type="email" name="office_email[]" class="form-control" placeholder="Email" value="{{ $email }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary remove-email" type="button">-</button>
                                        <button class="btn btn-outline-secondary add-email" type="button">+</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="form-group">
                            <label for="whatsapp_number">Whatsapp Number</label>
                            <input type="text" name="whatsapp_number" class="form-control" placeholder="Whatsapp Number"
                                id="whatsapp_number" value="{{ $sitesetting->whatsapp_number }}">
                        </div>

                        <div class="form-group">
                            <label for="company_registered_date">Company Registered Date</label>
                            <input type="date" name="company_registered_date" class="form-control"
                                placeholder="Enter Registered Date" id="company_registered_date"
                                value="{{ $sitesetting->company_registered_date }}">
                        </div>
                        <div class="form-group">
                            <label for="main_logo">Main Logo</label>
                            <input type="file" name="main_logo" class="form-control" placeholder="Main Logo"
                                id="main_logo" onchange="previewMainImage(event)">

                            <img id="main_preview" src="{{ asset('uploads/sitesetting/' . $sitesetting->main_logo) }}"
                                style="max-width: 300px; max-height:300px" />
                        </div>

                        <div class="form-group">
                            <label for="side_logo">Side Logo</label>
                            <input type="file" name="side_logo" class="form-control" placeholder="Side Logo"
                                id="side_logo" onchange="previewSideImage(event)">

                            <img id="side_preview" src="{{ asset('uploads/sitesetting/' . $sitesetting->side_logo) }}"
                                style="max-width: 300px; max-height:300px" />
                        </div>


                        <div class="form-group">
                            <label for="slogan">Slogan</label>
                            <input type="text" name="slogan" class="form-control" placeholder="Slogan" id="slogan"
                                value="{{ $sitesetting->slogan }}">
                        </div>

                        <div class="form-group">
                            <label for="facebook_link">Facebook URL</label>
                            <input name="facebook_link" class="form-control" placeholder="Facebook URL (https://)"
                                id="facebook_link" value="{{ $sitesetting->facebook_link }}">
                        </div>
                        <div class="form-group">
                            <label for="instagram_link">Insta URL</label>
                            <input name="instagram_link" class="form-control" placeholder="Insta URL (https://)"
                                id="instagram_link" value="{{ $sitesetting->instagram_link }}">
                        </div>

                        <div class="form-group">
                            <label for="snapchat_link">Snapchat URL</label>
                            <input name="snapchat_link" class="form-control" placeholder="Snapchat URL (https://)"
                                id="snapchat_link" value="{{ $sitesetting->snapchat_link }}">
                        </div>

                        <div class="form-group">
                            <label for="linkedin_link">Linkedin URL</label>
                            <input name="linkedin_link" class="form-control" placeholder="LinkedIn URL (https://)"
                                id="linkedin_link" value="{{ $sitesetting->linkedin_link }}">
                        </div>
                        <div class="form-group">
                            <label for="google_maps_link">Google Map</label>
                            <input name="google_maps_link" class="form-control" placeholder="Google Maps URL (https://)"
                                id="google_maps_link" value="{{ $sitesetting->google_maps_link }}">
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </section>




    </form>
    <script>
        const previewMainImage = e => {
            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = () => {
                const preview = document.getElementById('main_preview');
                preview.src = reader.result;
            };
        };

        const previewSideImage = e => {
            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = () => {
                const preview = document.getElementById('side_preview');
                preview.src = reader.result;
            };
        };
        
        $(document).ready(function() {
            // Add new address input field
            $(".add-address").click(function() {
                $("#office_addresses_container").append('<div class="input-group mb-3">' +
                    '<input type="text" name="office_address[]" class="form-control" placeholder="Address">' +
                    '<div class="input-group-append">' +
                    '<button class="btn btn-outline-secondary remove-address" type="button">-</button>' +
                    '<button class="btn btn-outline-secondary add-address" type="button">+</button>' +
                    '</div>' +
                    '</div>');
            });

            // Remove address input field
            $(document).on("click", ".remove-address", function() {
                $(this).parents(".input-group").remove();
            });

            // Add new contact input field
            $(".add-contact").click(function() {
                $("#office_contacts_container").append('<div class="input-group mb-3">' +
                    '<input type="text" name="office_contact[]" class="form-control" placeholder="Office Contact">' +
                    '<div class="input-group-append">' +
                    '<button class="btn btn-outline-secondary remove-contact" type="button">-</button>' +
                    '<button class="btn btn-outline-secondary add-contact" type="button">+</button>' +
                    '</div>' +
                    '</div>');
            });

            // Remove contact input field
            $(document).on("click", ".remove-contact", function() {
                $(this).parents(".input-group").remove();
            });

            // Add new email input field
            $(".add-email").click(function() {
                $("#office_emails_container").append('<div class="input-group mb-3">' +
                    '<input type="text" name="office_email[]" class="form-control" placeholder="Office Email">' +
                    '<div class="input-group-append">' +
                    '<button class="btn btn-outline-secondary remove-email" type="button">-</button>' +
                    '<button class="btn btn-outline-secondary add-email" type="button">+</button>' +
                    '</div>' +
                    '</div>');
            });

            // Remove email input field
            $(document).on("click", ".remove-email", function() {
                $(this).parents(".input-group").remove();
            });
        });

        

    </script>
    @endsection